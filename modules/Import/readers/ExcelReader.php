<?php
/**
 * Created by Jacobs.
 * Auth: jacobs@anviz.com
 * Copyright: Anviz Global Inc.
 * Date: 2017/12/25
 * Time: 14:01
 * FileName: ExcelReader.php
 */
vimport('~~/libraries/PHPExcel/PHPExcel.php');

class Import_ExcelReader_Reader extends Import_FileReader_Reader
{
    var $status = 'success';
    var $numberOfRecordsRead = 0;
    var $errorMessage = '';
    var $user;
    var $request;
    var $moduleModel;

    public function arrayCombine($key, $value)
    {
        $combine = array();
        $dup = array();
        for ($i = count($key) - 1; $i >= 0; $i--) {
            if (empty($key[$i]) && empty($value[$i]))
                continue;

            if (array_key_exists($key[$i], $combine)) {
                if (!$dup[$key[$i]]) $dup[$key[$i]] = 1;
                $key[$i] = $key[$i] . "(" . ++$dup[$key[$i]] . ")";
            }
            $combine[$key[$i]] = $value[$i];
        }
        return array_reverse($combine);
    }

    public function getFileHandler()
    {
        $filePath = $this->getFilePath();
        if (!file_exists($filePath)) {
            $this->status = 'failed';
            $this->errorMessage = "ERR_FILE_DOESNT_EXIST";
            return false;
        }

        $fileHandler = PHPExcel_IOFactory::load($filePath);
        if (!$fileHandler) {
            $this->status = 'failed';
            $this->errorMessage = "ERR_CANT_OPEN_FILE";
            return false;
        }
        return $fileHandler;
    }

    public function read()
    {
        global $default_charset;

        $fileHandler = $this->getFileHandler();
        $status = $this->createTable();
        if (!$status) {
            return false;
        }

        $data = array();

        $objWorksheet = $fileHandler->getActiveSheet();
        $totalRows = $objWorksheet->getHighestRow();
        $totalColumns = ord($objWorksheet->getHighestColumn());
        for ($i = 1; $i <= $totalRows; $i++) {
            if ($this->request->get('has_header') && $i == 0) continue;
            for ($j = 0; $j < $totalColumns; $j++) {
                $value = $objWorksheet->getCellByColumnAndRow($j, $i)->getValue();
                $data[$j] = $this->convertCharacterEncoding($value, $this->request->get('file_encoding'), $default_charset);
            }
        }

        unset($fileHandler);
        return $data;
    }
}
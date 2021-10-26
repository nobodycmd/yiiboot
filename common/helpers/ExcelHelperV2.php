<?php

namespace common\helpers;

use Exception;

/**
 * @brief 导出excel类库
 * @content
 *
 * $export = new ExcelHelperV2('download_user_list20200601');
 * $export->setTitle(['username','mobile']);
 * $export->setData(['张三','13300100010']);
 * $export->downLoad();
 *
 *
 */
class ExcelHelperV2
{
    //文件名
    private $fileName = 'download';

    //数据内容
    private $_data    = "";

    //构造函数
    public function __construct($fileName = '')
    {
        $this->setFileName($fileName);
    }

    //设置要导出的文件名
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @brief 写入内容操作，每次存入一行
     * @param $data array 一维数组
     */
    public function setTitle($data = array())
    {
        array_walk($data,function(&$val,$key)
        {
            $val = "<th style='text-align:center;background-color:green;color:#fff;font-size:12px;vnd.ms-excel.numberformat:@'>".$val."</th>";
        });
        $this->_data .= "<tr>".join($data)."</tr>";
    }

    /**
     * @brief 写入标题操作
     * @param $data array  数据
     */
    public function setData($data = array())
    {
        array_walk($data,function(&$val,$key)
        {
            $dataType = is_numeric($val) && strlen($val) >= 10 ? "vnd.ms-excel.numberformat:@" : "";
            $val = "<td style='text-align:center;font-size:12px;".$dataType."'>".$val."</td>";
        });
        $this->_data .= "<tr>".join($data)."</tr>";
    }

    //开始下载
    public function downLoad($data = '')
    {
        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$this->fileName.'_'.date('Y-m-d').'.xls');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $result = $data ? $data : "<table border='1'>".$this->_data."</table>";
        echo <<< OEF
<html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<body>
	{$result}
	</body>
</html>
OEF;
    }
}
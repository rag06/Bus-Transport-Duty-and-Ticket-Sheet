<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_pdf {
    
    function m_pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($params == NULL)
        {
            $param = '"en-GB-x","A4","","",10,10,20,20,5,5';          		
        }
         
        //return new mPDF($param);
        return new mPDF($params);
    }
}
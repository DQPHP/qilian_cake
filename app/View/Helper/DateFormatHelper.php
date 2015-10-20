<?php
App::uses('AppHelper', 'View/Helper');
class DateFormatHelper extends AppHelper{
    /*
     * 2014-10-12 ⇛ 10月12日(木)
     */
    public function makeDateFormat($date){
        $week_arr = array(
            '1' => '月', '2' => '火', '3' => '水', '4' => '木', '5' => '金', '6' => '土', '7' => '日'
        );
        $return_date = date("n月d日", strtotime($date)).'('.$week_arr[date("N", strtotime($date))].') '.date("H:i", strtotime($date));
        
        return $return_date;
    }
}

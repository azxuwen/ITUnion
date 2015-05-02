<?php
//行业类
class TradeAction extends CommonAction {
	/*
	 * 通过行业 ID 返回 行业的 真实名称
	 */
	public static function getTradeNameById($trade_id){
		 $t = M('Trade');
		 $condition = "K_TradeId = ". $trade_id;
		 $arr = $t->where($condition)->select();
		 return $arr[0]['K_TradeName'];
	}
}
?>
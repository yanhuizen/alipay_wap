<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/5
 * Time: 11:02
 */
namespace HuNanZai\Component\Pay\Package\Alipay_wap\Param;

use HuNanZai\Component\Pay\Package\Alipay_wap\Exception\InvalidParamException;

/**
 * Class PayParam
 *
 * 参考文档：https://doc.open.alipay.com/doc2/detail.htm?spm=0.0.0.0.UyOXYJ&treeId=60&articleId=103693&docType=1
 *
 * @package HuNanZai\Component\Pay\Package\Alipay_wap\Param
 */
class PayParam extends BaseParam
{
    public function __construct()
    {
        //default value
        $this->setDefaultService();
        $this->setDefaultPaymentType();
    }

    /**
     * 设置默认的请求服务地址
     */
    public function setDefaultService()
    {
        $this->params['service'] = 'alipay.wap.create.direct.pay.by.user';
    }

    /**
     * 支付类型
     */
    public function setDefaultPaymentType()
    {
        $this->params['payment_type'] = '1';  //商品购买，默认
    }

    /**
     * 设置合作者身份id(以2088开头的16位纯数字)
     *
     * @param $partner
     *
     * @throws InvalidParamException
     */
    public function setPartner($partner)
    {
        if (!is_string($partner) || !preg_match("/^2088[0-9]{12}$/", $partner)) {
            throw new InvalidParamException('2088开头16位数字', $partner);
        }

        $this->params['partner'] = $partner;
    }

    /**
     * 卖家支付宝用户号(以2088开头的16位纯数字)
     *
     * @param $seller_id
     *
     * @throws InvalidParamException
     */
    public function setSellerId($seller_id)
    {
        if (!is_string($seller_id) || !preg_match("/^2088[0-9]{12}$/", $seller_id)) {
            throw new InvalidParamException('2088开头16位数字', $seller_id);
        }

        $this->params['seller_id'] = $seller_id;
    }

    /**
     * 参数编码字符集(仅支持utf-8)
     *
     * @param $input_charset
     *
     * @throws InvalidParamException
     */
    public function setInputCharset($input_charset)
    {
        if ($input_charset != 'utf-8') {
            throw new InvalidParamException('utf-8', $input_charset);
        }

        $this->params['_input_charset'] = $input_charset;
    }

    /**
     * 商户订单号(String(64))
     *
     * @param $out_trade_no
     *
     * @throws InvalidParamException
     */
    public function setOutTradeNo($out_trade_no)
    {
        if (!is_string($out_trade_no) || strlen($out_trade_no) > 64 || strlen($out_trade_no) == 0) {
            throw new InvalidParamException('string(64)', $out_trade_no);
        }

        $this->params['out_trade_no'] = $out_trade_no;
    }

    /**
     * 付款金额(单位为人民币，范围0.01~100000000.00)
     *
     * @param $total_fee
     *
     * @throws InvalidParamException
     */
    public function setTotalFee($total_fee)
    {
        $total_fee = floatval($total_fee);
        if ($total_fee < 0.01 || $total_fee > 100000000.00) {
            throw new InvalidParamException('0.01~100000000.00', $total_fee);
        }

        $this->params['total_fee'] = $total_fee;
    }

    /**
     * 订单名称(商品标题/交易标题/订单标题/订单关键字 最长128个汉字)
     *
     * @param $subject
     *
     * @throws InvalidParamException
     */
    public function setSubject($subject)
    {
        if (!is_string($subject) || strlen($subject) > 256 || strlen($subject) == 0) {
             throw new InvalidParamException('string(256)', $subject);
        }

        $this->params['subject'] = $subject;
    }

    /**
     * [可空]服务器异步通知地址
     *
     * @param $notify_url
     */
    public function setNotifyUrl($notify_url)
    {
        $this->params['notify_url'] = $notify_url;
    }

    /**
     * [可空]页面同步跳转地址
     *
     * @param $return_url
     */
    public function setReturnUrl($return_url)
    {
        $this->params['return_url'] = $return_url;
    }

    /**
     * [可空]订单的描述
     *
     * @param $body
     */
    public function setBody($body)
    {
        $this->params['body'] = $body;
    }

    /**
     * [可空]设置商品的展示地址
     *
     * @param $show_url
     */
    public function setShowUrl($show_url)
    {
        $this->params['show_url'] = $show_url;
    }

    /**
     * [可空]设置超时时间
     *
     * @param $it_b_pay
     */
    public function setItBPay($it_b_pay)
    {
        $this->params['it_b_pay'] = $it_b_pay;
    }

    /**
     * [可空]设置钱包的token
     *
     * @param $extern_token
     */
    public function setExternToken($extern_token)
    {
        $this->params['extern_token'] = $extern_token;
    }

    /**
     * [可空]是否发起实名验证
     *
     * @param $rn_check
     */
    public function setRnCheck($rn_check)
    {
        $this->params['rn_check'] = $rn_check;
    }

    /**
     * [可空]买家证件号码
     *
     * @param $buyer_cert_no
     */
    public function setBuyerCertNo($buyer_cert_no)
    {
        $this->params['buyer_cert_no'] = $buyer_cert_no;
    }

    /**
     * [可空]买家真实姓名
     *
     * @param $buyer_real_name
     */
    public function setBuyerRealName($buyer_real_name)
    {
        $this->params['buyer_real_name'] = $buyer_real_name;
    }
}

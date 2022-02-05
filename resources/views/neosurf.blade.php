<form id="neopasssubmit" name="neopasssubmit" action="
https://pay.neosurf.com " method="post">
    <input type="number" name="amount" value="1000"/>
    <input type="hidden" name="currency" value="eur"/>
    <input type="hidden" name="language" value="en"/>
    <input type="hidden" name="merchantId" value="24616"/>
    <input type="hidden" name="merchantTransactionId" value="1570528895"/>
    <input type="text" name="subMerchantId" value="{{$subItems['subMerchantId']}}"/>
    <input type="hidden" name="test" value="yes"/>
    <input type="hidden" name="urlCallback"
           value="https://www.test.com/isAlive.php"/ [1]>
    <input type="hidden" name="urlKo"
           value="https://www.test.com/isAlive.php?result=ko"/ [2]>
    <input type="hidden" name="urlOk"
           value="https://www.test.com/isAlive.php?result=ok"/ [3]>
    <input type="hidden" name="urlPending"
           value="https://www.test.com/isAlive.php?result=pending"/ [4]>
    <input type="hidden" name="version" value="2"/>
    <input type="text" name="hash"
           value="{{$hash}}"/>
</form><script>document.forms["neopasssubmit"].submit();</script>

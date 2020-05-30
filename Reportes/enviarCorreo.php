<?php 
include "header.php";

?>
<script type="text/javascript">
/* var bcf_settings = { buttonText:'Contact Us', buttonTop:'30%', language:'en_US' }; // Better Contact Form Settings */
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0]; js = d.createElement(s); js.id = id;
    js.src = "//bettercontactform.com/contact/media/0/8/08c676af7bba0356eda81cfebbd40099ff499ef7.js";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, "script", "bcf-render"));</script>
<a id="bcf_trigger" href="http://bettercontactform.com" rel="bcf_trigger">Contact Form</a>
<?php
include "footer.php";
 ?>
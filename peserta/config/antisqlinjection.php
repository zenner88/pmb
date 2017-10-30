<?php
function replace_meta_chars($string){
return @eregi_replace("([*])|([|])|([;]|([`])","",$string);
}

while(list($keyx,$valuex) = each($_REQUEST)){
if(eregi("([*])|([|])|([;])",$valuex)){
//mail("camilo@cancun.com","Hack Alert","There's been a SQL Injection hacking attempt. $HTTP_REFERRER $REMOTE_ADDR","FROM:core@cancun.com,BCC:bernhardx@cancun.com");
}
}

reset ($_REQUEST);
while(list($keyx,$valuex) = each($_REQUEST)){
${$keyx} = replace_meta_chars($valuex);
//echo "$keyx $valuex
//";
}
//end anti SQL XSS script.
?>
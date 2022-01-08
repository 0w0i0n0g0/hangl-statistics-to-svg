<!DOCTYPE HTML>  
<html>
<head>
  <meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width"/>
  <style>
     main {
      position: absolute;
      top:50%;
      left: 50%;
      transform:translate(-50%, -50%);
      -webkit-transform:translate(-50%, -50%);
      text-align: center;
      width: 70vw;
      border: 1px solid #d5d9d9;
      border-radius: 10px;
      padding: 20px 20px 20px 20px;
    }

    .error {
      color: #FF0000;
    }

    .button {
      -webkit-appearance: none;
      -webkit-border-radius: 0;
      background-color: #e5e5e5;
      border: 1px solid #d5d9d9;
      border-radius: 8px;
      box-shadow: rgba(213, 217, 217, .5) 0 2px 5px 0;
      box-sizing: border-box;
      color: #000000;
      cursor: pointer;
      display: inline-block;
      font-family: "Amazon Ember",sans-serif;
      font-size: 20px;
      line-height: 40px;
      padding: 0 10px 0 11px;
      position: relative;
      text-align: center;
      touch-action: manipulation;
      vertical-align: middle;
      width: 100px;
      font-weight: normal;
    }

    .button:hover {
      background-color: #f7fafb;
    }

    .button:focus {
      border-color: #727272;
      box-shadow: rgba(213, 217, 217, .5) 0 2px 5px 0;
      outline: 0;
    }

    input[class="urlIntput"] {
      background-color: #fff;
      border: 1px solid #d5d9d9;
      border-radius: 8px;
      box-shadow: rgba(213, 217, 217, .5) 0 2px 5px 0;
      box-sizing: border-box;
      color: #0f1111;
      display: inline-block;
      font-family: "Amazon Ember",sans-serif;
      font-size: 13px;
      line-height: 29px;
      padding: 0 10px 0 11px;
      position: relative;
      text-align: center;
      touch-action: manipulation;
      vertical-align: middle;
      width: 200px;
    }

    #svgUrl {
      background-color: #fff;
      border: 0px;
      border-radius: 8px;
      box-shadow: rgba(213, 217, 217, .5) 0 2px 5px 0;
      box-sizing: border-box;
      color: #0f1111;
      cursor: pointer;
      display: inline-block;
      font-family: "Amazon Ember",sans-serif;
      font-size: 13px;
      line-height: 29px;
      padding: 0 10px 0 11px;
      position: relative;
      text-align: center;
      text-decoration: none;
      user-select: none;
      -webkit-user-select: none;
      touch-action: manipulation;
      vertical-align: middle;
      width: 70vw;
    }
  </style>
</head>

<body>  
<main>
<?php
// define variables and set to empty values
$urlErr = $url2Err = $url3Err = "";
$url    = $url2 = $url3 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["url"])) {
        $urlErr = "url is required.";
    } else {
        $url = test_input($_POST["url"]);
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $urlErr = "Invalid url format";
        }
    }
    
    if (empty($_POST["url2"])) {
    } else {
        $url2 = test_input($_POST["url2"]);
        if (!filter_var($url2, FILTER_VALIDATE_URL)) {
            $url2Err = "Invalid url format";
        }
    }
    
    if (empty($_POST["url3"])) {
    } else {
        $url3 = test_input($_POST["url3"]);
        if (!filter_var($url3, FILTER_VALIDATE_URL)) {
            $url3Err = "Invalid url format";
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h1>Han.gl Clicks to SVG url Maker 🔗</h1>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php
echo htmlspecialchars($_SERVER["PHP_SELF"]);
?>">  
  <span class="error">* </span>
  url: <input class="urlIntput" type="url" pattern="https://.*" required name="url" value="<?php echo $url;?>"/>
  <span class="error"><?php echo $urlErr;?></span>
  <br><br>
  url2: <input class="urlIntput" type="url" pattern="https://.*" name="url2" value="<?php echo $url2;?>"/>
  <span class="error"><?php echo $url2Err;?></span>
  <br><br>
  url3: <input class="urlIntput" type="url" pattern="https://.*" name="url3" value="<?php echo $url3;?>"/>
  <span class="error"><?php echo $url3Err;?></span>
  <br><br>
  <input class="button" type="submit" name="submit" value="Submit!"/>  
</form>

<?php
echo "<h2>SVG link 👇</h2>";
$parameter = "?url=" . $url . "&url2=" . $url2 . "&url3=" . $url3;
?>

<p type="text" value="<?php
echo (isset($parameter)) ? "https://hangl-statistics-to-svg.herokuapp.com/" . $parameter : '';
?>" id="svgUrl">
<?php
echo (isset($parameter)) ? "https://server.com/" . $parameter : '';
?>
</p>
<br><br>
<button class="button" onclick="copySvgUrl()">Copy!</button>
</main>

<script>
function copySvgUrl() {
  var copyText = document.getElementById("svgUrl");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(copyText.value);
  alert("Copied!");
}
</script>

</body>

</html>
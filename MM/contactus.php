<?php
require_once "../functions.php";
if (isset($_POST['Name'], $_POST['Email'], $_POST['Message'])) {
    $database = new Database();
    $query = "INSERT INTO Messages2Admin SET
        Name = :Name,
        Email = :Email,
        Message = :Message
    ;";
    $database->query($query);
    $database->bind(":Name", trim($_POST['Name']));
    $database->bind(":Email", trim($_POST['Email']));
    $database->bind(":Message", trim($_POST['Message']));
    if ($database->execute()) {
        $subject = "Message from myfarm.com";
        $message = trim($_POST['Message']);
        $mail_header = "FROM: <".$_POST['Email'].">\r\n";
        $mail_header .= "Content-type: text/html\r\n";
        mail ('den.lahpai@icloud.com', $subject, $message, $mail_header);
        echo "လုပ်ဆောင်မှူ အောင်မြင်ပါတယ်! ကျေးဇူး အထူးတင် ရှိပါတယ်!";
    }
    else {
        echo "ဆက်သွယ်မှူ ယာယီ ပြတ်တောက် သွားပါတယ်! နောက်တစ်ခေါက် ပြန်လည်လုပ်ဆောင် ပေးပါ!";
    }
}
?>

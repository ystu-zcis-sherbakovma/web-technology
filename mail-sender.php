<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $address = strip_tags(trim($_POST["address"]));
    $products = implode(", ", $_POST["products"]);

    $to = "***@***"; // Заменить
    $subject = "Новый заказ";
    $email_content = "Имя: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Адрес доставки: $address\n\n";
    $email_content .= "Выбранные продукты: $products\n";
    $headers = "From: ***@***\r\nX-Mailer: PHP/" . phpversion();

	if (mail($to, $subject, $email_content, $headers)) {
        error_log("Заказ успешно отправлен: " . $email_content);
		header("Location: index.html"); // Перенаправление на index.html
		exit();
    } else {
        error_log("Ошибка отправки заказа: " . $email_content);
		header("Location: index.html"); 
        exit();
    }
	
	
}
?>

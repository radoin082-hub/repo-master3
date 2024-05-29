<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Contact Form</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="css/contact-style.css">
</head>
<body>
  <div class="contact-section">
    <div class="contact-info">
      <div><i class="fas fa-map-marker-alt"></i>University, Biskra, Algeria</div>
      <div><i class="fas fa-envelope"></i>contact@email.com</div>
      <div><i class="fas fa-phone"></i>+00 0000 000 000</div>
      <div><i class="fas fa-clock"></i>Mon - Fri 8:00 AM to 5:00 PM</div>
    </div>
    <div class="contact-form">
      <h2>Contact Us</h2>
      <form class="contact" action="https://api.web3forms.com/submit" method="POST">
        <input type="hidden" name="access_key" value="ab2169f2-e69e-49f4-bcb0-660799c70a6f">
        <input type="text" name="name" class="text-box" placeholder="Your Name" required>
        <input type="email" name="email" class="text-box" placeholder="Your Email" required>
        <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
        <input type="submit" name="submit" class="send-btn" value="Send">
      </form>
    </div>
  </div>
</body>
</html>
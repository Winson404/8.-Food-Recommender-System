<?php include 'navbar.php'; ?>

<link rel="stylesheet" href="css/contact.css">
 <!-- main -->
</head>
<main class="page">
 <div id="container">
    <div class="content">
        <div class="image-box">
         <img src="inTouch.png" alt=""> 
        </div>
      <form action="#">
        <div class="topic">Send us a message</div>
        <div class="input-box">
          <input type="text" required>
          <label>Enter your name</label>
        </div>
        <div class="input-box">
          <input type="text" required>
          <label>Enter your email</label>
        </div>
        <div class="message-box">
          <label>Enter your message</label>
           <textarea
              id="message"
              cols="30"
              rows="10"
              placeholder="Enter your message"
              required
            ></textarea>
        </div>
        <div class="input-box">
          <input type="submit" value="SUBMIT">
        </div>
      </form>
    </div>
  </div>
</main>


<?php include 'footer.php'; ?>

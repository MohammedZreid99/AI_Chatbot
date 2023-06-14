<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat GPT</title>

    <!-- jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- jQuery-->

    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/ChatGPT_logo.svg/1200px-ChatGPT_logo.svg.png" type="image/x-icon">
</head>
<body>

    <div class="chat">

        <!-- Header -->
        <div class="top">
          <img src="https://i.pinimg.com/564x/38/ea/78/38ea7829a5d1a502c644cd22ca35d9af.jpg" alt="Avatar" height="100" width="100">
          <div>
            <p>Michael Scott</p>
            <small>Online</small>
          </div>
        </div>
        <!-- End Header -->
      
        <!-- Chat -->
        <div class="messages">
          <div class="left message">
            <img src="https://i.pinimg.com/564x/38/ea/78/38ea7829a5d1a502c644cd22ca35d9af.jpg" alt="Avatar" height="100" width="100">
            <p>Start chatting with Chat GPT AI below!!</p>
          </div>
        </div>
        <!-- End Chat -->
      
        <!-- Footer -->
        <div class="bottom">
          <form>
            <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
            <button type="submit"></button>
          </form>
        </div>
        <!-- End Footer -->
      
      </div>
</body>

<script>
    //Broadcast messages
    $("form").submit(function (event) {
    event.preventDefault();

    $.ajax({
      url: "https://api.openai.com/v1/chat/completions",
      method: 'POST',
      headers: {
        "Content-Type": "application/json",
        "Authorization": "Bearer {{env('CHAT_GPT_KEY')}}"
      },
      data: JSON.stringify({
        "model": "gpt-3.5-turbo",
        "messages": [
          {
            "role": "user",
            "content": $("form #message").val()
          }
        ],
        "temperature": 0,
        "max_tokens": 2048
      })
    }).done(function (res) {
      console.log(res.choices[0].message.content)

      //Populate sending message
      $(".messages > .message").last().after('<div class="right message">' +
        '<p>' + $("form #message").val() + '</p>' +
        '<img src="https://i.pinimg.com/564x/38/ea/78/38ea7829a5d1a502c644cd22ca35d9af.jpg" alt="Avatar" height="100" width="100">' +
        '</div>');

      //Populate receiving message
      $(".messages > .message").last().after('<div class="left message">' +
        '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/ChatGPT_logo.svg/1200px-ChatGPT_logo.svg.png" alt="Avatar" height="100" width="100">' +
        '<p>' + res.choices[0].message.content + '</p>' +
        '</div>');

      //Cleanup
      $("form #message").val('');
      $(document).scrollTop($(document).height());
    });
  });
  
  </script>
</html>
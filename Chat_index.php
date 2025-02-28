<?php
session_start();

$_SESSION['player_id'] = 1;
$_SESSION['nickname'] = 'TestUser';

include __DIR__ . "/partials/head.php"; 
?>

<body>
    <?php include __DIR__ . "/partials/header.php"; ?>

    <section class="bot-chat">
        <div class="chat">
            <div class="bleu">
                <title>Chat Général</title>
                <div class="chat-tchat">
                    <div class="icon-chat"><i class="fa-solid fa-circle-user"></i></div>
                    <div class="title-chat"><h1 class="title">Chat Général</h1></div>
                </div>
            </div>

            <div class="chat-container"></div>

            <div class="footer-input">
                <input type="text" name="message" id="message" placeholder="Votre message..." required>
                <button type="submit" id="sendMessage">Envoyer</button>
            </div>
        </div>
        <script src="/ProjetChess/Chess/public/js/Chat.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const nicknameSession = '<?php echo htmlspecialchars($_SESSION['nickname']); ?>';
                loadMessages(nicknameSession);
                setInterval(function() {
                    loadMessages(nicknameSession);
                }, 3000);
            });
        </script>
    </section>

    
</body>
</html>
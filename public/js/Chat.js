const rootpath = '/ProjetChess/Chess/Chat';

document.getElementById("sendMessage").addEventListener("click", function () {
    const message = document.getElementById("message").value;

    if (message.trim() === "") {
        alert("Le message ne peut pas être vide !");
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", `${rootpath}/chat.php`, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                document.getElementById("message").value = "";
            } else {
                alert("Erreur lors de l'envoi du message.");
            }
        }
    };
    xhr.send(`message=${encodeURIComponent(message)}`);
});

function limitPseudo(pseudo, limit = 10) {
    if (pseudo.length > limit) {
        return pseudo.slice(0, limit) + '..';
    }
    return pseudo;
}

async function loadMessages(nicknameSession) {
    const chatContainer = document.querySelector('.chat-container');
    try {
        const response = await fetch(`${rootpath}/chat.php`);
        const messages = await response.json();

        chatContainer.innerHTML = '';
        messages.forEach(message => {
            const messageDiv = document.createElement('div');
            const pseudo = limitPseudo(message.nickname, 10);
            if (message.nickname === nicknameSession) {
                messageDiv.classList.add('message', 'message-1');
                messageDiv.innerHTML = `
                    <div>
                        <p class="pseudo-chat1">Moi</p>
                    </div>
                    <div class="container-message1">
                        <p class="text-chat1">${message.message}</p>
                        <p class="time-chat1">${new Date(message.date).toLocaleString()}</p>
                    </div>
                `;
            } else {
                messageDiv.classList.add('message', 'message-2');
                messageDiv.innerHTML = `
                    <div>
                        <p class="pseudo-chat2">${pseudo}</p>
                    </div>
                    <div class="container-message2">
                        <p class="text-chat2">${message.message}</p>
                        <p class="time-chat2">${new Date(message.date).toLocaleString()}</p>
                    </div>
                `;
            }
            chatContainer.appendChild(messageDiv);
        });
        chatContainer.scrollTop = chatContainer.scrollHeight;
    } catch (error) {
        console.error("Erreur lors du chargement des messages :", error);
    }
}
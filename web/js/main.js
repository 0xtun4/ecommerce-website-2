var socket = io('http://localhost:3000');
var messageForm = document.querySelector('#messageForm');
// Xử lý khi kết nối thành công
socket.on('connect', () => {
    console.log('Connected to the server');
});

// Xử lý khi nhận được tin nhắn từ server
socket.on('chat message', msg => {
    const messageElement = document.createElement('li');

    // Hiển thị thông tin người gửi (username và userimage)
    const senderInfo = document.createElement('div');
    senderInfo.className = 'sender-info';

    const userImageElement = document.createElement('img');
    userImageElement.src = userimage; // Sử dụng biến userimage

    const usernameElement = document.createElement('span');
    usernameElement.textContent = username; // Sử dụng biến username

    senderInfo.appendChild(userImageElement);
    senderInfo.appendChild(usernameElement);

    messageElement.appendChild(senderInfo);

    const textElement = document.createElement('p');
    textElement.textContent = msg;

    messageElement.appendChild(textElement);

    document.getElementById('messageArea').appendChild(messageElement);
});
// Gửi tin nhắn lên server khi người dùng ấn nút gửi
document.getElementById('messageForm').addEventListener('submit', e => {
    e.preventDefault();
    const message = document.getElementById('message').value;
    socket.emit('chat message', {
        message,
        username,
        userimage
    });
    document.getElementById('message').value = '';
});


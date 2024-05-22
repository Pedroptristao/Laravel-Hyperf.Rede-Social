import React, { useState, useEffect, useRef } from 'react';
import { useNavigate } from 'react-router-dom';

const WebSocketClient = () => {
  const [messages, setMessages] = useState([]);
  const [socket, setSocket] = useState(null);
  const [connectedUsers, setConnectedUsers] = useState(0);
  const [inputMessage, setInputMessage] = useState('');
  const [user, setUser] = useState(null);
  const navigate = useNavigate();
  const messagesEndRef = useRef(null);
  
  useEffect(() => {
    const loggedUser = JSON.parse(localStorage.getItem('user'));
    setUser(loggedUser);

    const ws = new WebSocket('ws://localhost:9502');

    ws.onopen = () => {
      console.log('Connected to WebSocket server');
      if (!socket) {
        setSocket(ws);
      }
    };

    ws.onmessage = (event) => {
      console.log(event);
      const data = JSON.parse(event.data);
      if (data.type === 'message') {
        setMessages((prevMessages) => [...prevMessages, data.message]);
      } else if (data.type === 'connectedUsers') {
        setConnectedUsers(data.count);
      }
    };

    ws.onclose = () => {
      console.log('Disconnected from WebSocket server');
      setSocket(null);
    };

    return () => {
      if (socket) {
        socket.close();
      }
    };
  }, [socket, messages]);

  useEffect(() => {
    scrollToBottom();
  }, [messages]);

  const scrollToBottom = () => {
    if (messagesEndRef.current) {
      messagesEndRef.current.scrollIntoView({ behavior: 'smooth' });
    }
  };

  const handleSendMessage = () => {
      socket.send(JSON.stringify(inputMessage));
  };

  const handleLogout = () => {
    localStorage.clear();
    navigate('/');
  };

  return (
    <div style={{ position: 'relative', minHeight: '100vh' }}>
      <h1>Chat Room</h1>
      <div style={{ maxHeight: 'calc(100vh - 200px)', overflowY: 'auto' }}>
        {messages.map((msg, index) => (
          <div key={index}>{user.first_name} {user.last_name}: {msg}</div>
        ))}
        <div ref={messagesEndRef} />
      </div>
      <div style={{ position: 'fixed', bottom: 0, left: 0, width: '99%', padding: '10px', backgroundColor: '#f0f0f0', borderTop: '1px solid #ccc' }}>
        <div style={{ fontSize: 12 }}>
            <p>Connected Users: {connectedUsers}</p>
        </div>
        <div style={{ display: 'flex', alignItems: 'center' }}>
          <input
            type="text"
            value={inputMessage}
            onChange={(e) => setInputMessage(e.target.value)}
            placeholder="Enter message"
            style={{ flex: 1, marginRight: '10px', padding: '5px', blockSize: 50 }}
          />
          <button onClick={handleSendMessage} style={{ padding: '5px 10px' }}>Send</button>
          <button onClick={handleLogout} style={{ marginLeft: '10px', padding: '5px 10px' }}>Logout</button>
        </div>
      </div>
    </div>
  );
};

export default WebSocketClient;

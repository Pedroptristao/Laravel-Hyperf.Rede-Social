import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import LoginPage from './components/LoginPage';
import WebSocketClient from './components/ChatPage';

const App = () => {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<LoginPage />} />
        <Route path="/chat" element={<WebSocketClient />} />
        {/* You can add more routes here */}
      </Routes>
    </Router>
  );
};

export default App;

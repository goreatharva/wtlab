const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');
const bodyParser = require('body-parser');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

const app = express();
app.use(cors());
app.use(bodyParser.json());

// MySQL Connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root', // Your MySQL username (default is root)
    password: '', // Your MySQL password (default is empty for XAMPP)
    database: 'college_complaints'
});

db.connect((err) => {
    if (err) throw err;
    console.log('MySQL Connected...');
});

// Register User (for students)
app.post('/register', async (req, res) => {
    const { username, password } = req.body;
    const hashedPassword = await bcrypt.hash(password, 10);
    
    db.query('INSERT INTO users (username, password, role) VALUES (?, ?, ?)', 
        [username, hashedPassword, 'student'], (err) => {
            if (err) return res.status(400).send(err);
            res.sendStatus(201);
        });
});

// Login User
app.post('/login', async (req, res) => {
    const { username, password } = req.body;
    
    db.query('SELECT * FROM users WHERE username = ?', [username], async (err, results) => {
        if (err || results.length === 0) return res.sendStatus(401);
        
        const user = results[0];
        if (!(await bcrypt.compare(password, user.password))) return res.sendStatus(401);
        
        const token = jwt.sign({ id: user.id, role: user.role }, 'secret_key');
        res.json({ token });
    });
});

// Submit Complaint
app.post('/complaint', (req, res) => {
    const { studentId, complaintText } = req.body;
    
    db.query('INSERT INTO complaints (student_id, complaint_text) VALUES (?, ?)', 
        [studentId, complaintText], (err) => {
            if (err) return res.status(400).send(err);
            res.sendStatus(201);
        });
});

// Get All Complaints (for admin)
app.get('/complaints', (req, res) => {
    db.query('SELECT * FROM complaints', (err, results) => {
        if (err) return res.status(400).send(err);
        res.json(results);
    });
});

// Start Server
app.listen(5000, () => {
    console.log('Server is running on http://localhost:5000');
});
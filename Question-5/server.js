const express = require("express");
const mysql = require("mysql2");
const app = express();

app.use(express.json());

// MySQL connection
const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "root",
  database: "shoppingcart"
});

db.connect((err) => {
  if (err) {
    console.error("Database connection failed:", err);
  } else {
    console.log("✅ Connected to MySQL");
  }
});

// GET API - fetch all students
app.get("/api/students", (req, res) => {
  const sql = "SELECT * FROM students";
  db.query(sql, (err, results) => {
    if (err) {
      res.status(500).json({ error: "Database query failed" });
    } else {
      res.json(results);
    }
  });
});

// Start server
app.listen(3000, () => {
  console.log("🚀 Express server running at http://localhost:3000");
});

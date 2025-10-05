const express = require("express");
const axios = require("axios");
const app = express();
app.use(express.json());

app.get("/call-php-api", async (req, res) => {
    try {
        const response = await axios.get("http://localhost/practical_assignment-3/Question-6/server.php");
        res.json(response.data);
    } catch (err) {
        res.status(500).send(err.message);
    }
});

app.listen(3000, () => console.log("Server running on port 3000"));

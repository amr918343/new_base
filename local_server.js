const express = require("express");
const http = require("http");
const socketIO = require("socket.io");
const redisAdapter = require("socket.io-redis");

const app = express();
const server = http.createServer(app);
const io = socketIO(server, {
    adapter: redisAdapter({ host: "localhost", port: 6379 }),
});

server.listen(3000, () => {
    console.log("Server listening on port 3000");
});

io.on("connection", (socket) => {
    console.log("A user has connected");

    socket.on("disconnect", () => {
        console.log("A user has disconnected");
    });
});

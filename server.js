const fs = require("fs");
const https = require("https");
const express = require("express");
const app = express();
const server = https.createServer(
    {
        key: fs.readFileSync("/path/to/private.key"),
        cert: fs.readFileSync("/path/to/certificate.crt"),
    },
    app
);
const io = require("socket.io")(server);
const redis = require("redis");

// create a Redis client
const redisClient = redis.createClient();

// subscribe to the 'chat' channel
redisClient.subscribe("chat");

// middleware for Socket.IO
io.use((socket, next) => {
    const userId = socket.handshake.query.userId;

    redisClient.get(userId, (err, data) => {
        if (err) {
            return next(new Error("Redis error"));
        }

        if (!data) {
            return next(new Error("User not found"));
        }

        socket.userId = userId;
        next();
    });
});

// Socket.IO event handlers
io.on("connection", (socket) => {
    console.log("A user connected");

    // listen for chat messages
    socket.on("chat message", (msg) => {
        // publish the message to the 'chat' channel
        redisClient.publish(
            "chat",
            JSON.stringify({
                userId: socket.userId,
                message: msg,
            })
        );
    });

    socket.on("disconnect", () => {
        console.log("A user disconnected");
    });
});

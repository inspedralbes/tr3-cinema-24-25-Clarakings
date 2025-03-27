const express = require('express');
const { createServer } = require('http');
const { Server } = require('socket.io');

const app = express();
const port = 3727;
const server = createServer(app);

const roomsList = [];

const io = new Server(server, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST'],
        credentials: true,
        allowedHeaders: ["Access-Control-Allow-Origin"],
    }
});

io.on('connection', (socket) => {
    // console.log(`user conectado ${socket.id}`);

    socket.on('connectToRoom', (room) => {
        // console.log('conectado a la sala', room);
        socket.join(room);
        roomsList[room] = roomsList[room] ? roomsList[room] : [];
        roomsList[room].push({'socket_id': socket.id, 'seats': []});
        // console.log(roomsList);
        io.to(room).emit('updateSeatsRoom', roomsList[room]);
    });

    socket.on('updateSeats', (data) => {
        const { room, seats } = data;
        roomsList[room].forEach((user) => {
            if (user['socket_id'] == socket.id) {
                user.seats = seats;
            }
        });
        io.to(room).emit('updateSeatsRoom', roomsList[room]);
    });

    socket.on('exitFromRoom', (room) => {
        // console.log(`Usuario ${socket.id} saliendo de la sala ${room}`, roomsList[room]);
        if (socket.rooms.has(room)) {
            socket.leave(room);
            if (roomsList[room]) {
                roomsList[room] = roomsList[room].filter(user => user['socket_id'] != socket.id);
            }
            // console.log('Lista de usuarios en la sala:', roomsList[room]);
        } else {
            // console.log('El socket no está unido a la sala ', room);
        }
    });

    socket.on('disconnect', () => {
        let roomsUserEstate = [];
        Object.keys(roomsList).forEach((roomKey) => {
            const room = roomsList[roomKey];
            const updatedRoom = room.filter(user => user.socket_id !== socket.id);
            if (updatedRoom.length !== room.length) { // Si se eliminó algún usuario
                roomsUserEstate.push(roomKey);
                roomsList[roomKey] = updatedRoom; // Actualizar la lista de usuarios en la sala
            }
        });
        // Emitir actualización a las salas afectadas
        roomsUserEstate.forEach(room => {
            io.to(room).emit('updateSeatsRoom', roomsList[room]);
        });
        // console.log('user desconectado ' + socket.id);
    });
    

    // socket.on('disconnect', () => {
    //     let roomsUserEstate = [];
    //     roomsList.forEach((room) => {
    //         // console.log(room);
    //         if (room.array == room.array.filter(user => user['socket_id'] != socket.id)) {   
    //             roomsUserEstate.push(room);
    //         }
    //         // room = room.array.forEach(user => {
    //         //     userToErase = user.findIndex(user => user.socket_id == socket.id);
    //         //     room.splice(userToErase, 1);
    //         // });
    //     });
    //     // console.log(roomsList);
    //     for (let i = 0; i < roomsUserEstate.length; i++) {
    //         io.to(roomsUserEstate[i]).emit('updateSeatsRoom', roomsList[roomsUserEstate[i]]);
    //     }
    //     // console.log('user desconectado ' + socket.id);
    // });
})

server.listen(port, () => {
    // console.log(`Server running on port ${port}`)
})

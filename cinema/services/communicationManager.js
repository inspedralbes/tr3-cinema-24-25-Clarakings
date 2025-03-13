const url = 'http://localhost:8001/api/api';
//const url = 'http:///laravel/public/api'; //producción

export function getAllMovies() {
    return new Promise((resolve, reject) => {
        fetch(`${url}/movies`)
            .then(response => {
                if (response.status == 200) {
                    return response.json();
                } else {
                    reject('Error al obtener las peliculas');
                }
            }).then(data => {
                JSON.stringify(data);
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

export function getMovie(id) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/movie/${id}`)
            .then(response => {
                if (response.status == 200) {
                    return response.json();
                } else {
                    reject('Error al obtener la pelicula');
                }
            }).then(data => {
                JSON.stringify(data);
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

export function getAllSessions() {
    return new Promise((resolve, reject) => {
        fetch(`${url}/sessions`)
            .then(response => {
                if (response.status == 200) {
                    return response.json();
                } else {
                    reject('Error al obtener las funciones');
                }
            }).then(data => {
                JSON.stringify(data);
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

export function getSessionByMovieId(id_movie) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/movie_session/${id_movie}`)
            .then(response => {
                if (response.status == 200) {
                    return response.json();
                } else {
                    reject('Error al obtener las funciones');
                }
            }).then(data => {
                JSON.stringify(data);
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

export function getSession(id) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/session/${id}`)
            .then(response => {
                if (response.status == 200) {
                    return response.json();
                } else {
                    reject('Error al obtener la funcion');
                }
            }).then(data => {
                JSON.stringify(data);
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

export function getOccupiedSeats(id) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/session/${id}/entradas`)
            .then(response => {
                if (response.status == 200) {
                    return response.json();
                } else {
                    reject('Error al obtener los asientos ocupados');
                }
            }).then(data => {
                JSON.stringify(data);
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

export function postValidateEmail (data) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/entradas/validate`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al validar el email: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function postBuyEntradas (data) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/entradas`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al comprar las entradas: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function postRegister (user) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(user)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al registrar el usuario: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function postLogin (user) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(user)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al iniciar sesión: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function postLogout(token) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/logout`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        }).then(response => {
            if (response.status === 200) {
                return response.json();
            } else {
                reject('Error al cerrar sesión: ' + response.statusText);
            }
        }).then(data => {
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function getEntradasWithEmailSession (data, token) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/entradas/searchIdEmail`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(data)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al obtener las entradas: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function getEntradasWithEmail (data, token) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/entradas/searchEmail`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(data)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al obtener las entradas: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function addSession (data, token) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/addSession`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(data)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al añadir la función: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function updateSession (data, token) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/updateSession`, {
        method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(data)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al actualizar la función: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function deleteSession (id, token) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/deleteSession/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al eliminar la función: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function addMovie (data, token) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/addMovie`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(data)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al añadir la película: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function updateMovie (data, token) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/updateMovie`, {
        method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(data)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al actualizar la película: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function deleteMovie (id, token) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/deleteMovie/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al eliminar la película: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}

export function moviesFreeSession (token) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/moviesFree`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al obtener las películas sin función: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}
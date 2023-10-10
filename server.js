import http from 'http';

// Create the server
const server = http.createServer((req, res) => {
  res.statusCode = 200;
  res.setHeader('Content-Type', 'text/plain');
  res.end('Hello, world!');
});

// Start listening on a port
server.listen(6001, '192.168.0.125', () => {
  console.log('Server is running on http://192.168.0.125:6001/');
});

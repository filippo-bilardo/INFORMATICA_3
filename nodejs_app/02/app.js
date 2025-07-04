const express = require('express');
const app = express();
const port = 3001;

app.get('/', (req, res) => {
  res.send('Hello, World! nginx proxy e Node js sulla porta 3001');
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}/`);
});

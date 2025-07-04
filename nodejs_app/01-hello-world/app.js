const express = require('express');
const app = express();
const port = 3000;
app.get('/', (req, res) => {
  res.send('Hello, World! nginx proxy e Node js sulla porta 3000');
});
app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}/`);
});

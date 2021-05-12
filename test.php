<?php include('includes/header.php');?>
<button class="btn-toggle">Toggle Dark-Mode</button>
<h1>Hey there! This is just a title</h2>
  <p>I am just a boring text, existing here solely for the purpose of this demo</p>
  <p>And I am just another one like the one above me, because two is better than having only one</p>
<style type="text/css">
body {
  --text-color: #222;
  --bkg-color: #fff;
}
body.dark-theme {
  --text-color: #eee;
  --bkg-color: #121212;
}

@media (prefers-color-scheme: dark) {
  /* defaults to dark theme */
  body {
    --text-color: #eee;
    --bkg-color: #121212;
  }
  body.light-theme {
    --text-color: #222;
    --bkg-color: #fff;
  }
}

* {
  font-family: Arial, Helvetica, sans-serif;
}

body {
  background: var(--bkg-color);
}

h1,
p {
  color: var(--text-color);
}
</style>

<script type="text/javascript">
const btn = document.querySelector(".btn-toggle");
const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");

btn.addEventListener("click", function () {
  if (prefersDarkScheme.matches) {
    document.body.classList.toggle("light-theme");
  } else {
    document.body.classList.toggle("dark-theme");
  }
});
</script>
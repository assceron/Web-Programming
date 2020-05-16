

    <form action="includes/logout.inc.php" method="POST">
      <p>
        <button id="logoutt-button" type="submit" name="submit">Logout</button>
      </p>
    </form>

    <p>
      <button onclick="reset()">Cancella Selezione</button>
    </p>
    <form method="post" action="includes/deleteMan.inc.php">
      <p>
        <button type="submit" name="deleteLast">Rimuovi Ultimo</button>
      </p>
    </form>
    <p>
      <button id="sendReq" type="submit" name="submit" onclick = MyAjax()>Invia</button>
    </p>

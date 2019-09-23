<?php
session_start();

echo "<div>You are loged in ".$_SESSION["nick"]."</div>";
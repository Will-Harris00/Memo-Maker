<?php
if ($_SERVER['REQUEST_METHOD']!="GET") {
    http_response_code(405);
    die(); }

if (!isset($_GET["code"])) {
    http_response_code(404);
    die(); }

define(PG,"We use computers in almost all aspects of our daily lives and throughout science, so it is easy to take them 
for granted. However, in order that we can use computers to solve new problems and create new things, we have to be able 
to program them. This module introduces you to programming and problem solving with a computer.  You will learn how to 
formulate an algorithm to solve a problem, and you will acquire the skills to write, test and debug programs.");
define(OO,"This module will introduce you to object-oriented problem-solving methods and provide you with 
object-oriented (OO) techniques for the analysis, design and implementation of solutions. We will introduce you to these 
concepts, and you will develop skills with a new programming language. By the end of this module, you will be able to 
apply these skills to design and implement small applications");
define(WD, "Today, the World Wide Web is a ubiquitous part of everyday life, and an attractive and effective Web 
presence is vital for any organisation or business. In this module, you will learn about the techniques and technologies 
that are used to develop usable, accessible, efficient, robust and secure Web sites. These techniques and technologies 
will be demonstrated by writing programs for both Web clients (typically, browsers) and Web servers. In both cases, the 
need for portability imposes constrains not found when writing programs for a single operating system.");
switch ($_GET["code"]) {
    case "ECM1400": echo PG; break;
    case "ECM1410": echo OO; break;
    case "ECM1417": echo WD; break;
    default: "No description";
}?>
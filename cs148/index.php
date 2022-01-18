<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>CS 148 Database Design for the web</title>
        <meta name="author" content="Lucía Carrera">
        <meta name="description" content="A site map to all assignments for CS148.">
        <style>
             /* basic CSS */
             body{
                margin: auto;
                padding: 3%;
                width: 90%;
            }

            figure {
                border: thin solid darkslategray;
                padding: 1%;
                text-align: center;
            }

            figcaption {
                color: #839e99;
                font-style: italic;
                text-align: center;
            }

            img{
                border-radius: 3%;
                max-width: 100%
            }

            .right{
                float: right;
                margin-left: 3%;
            }

            .small {
                width: 20%;
            }

            /* Setting up a grid layout for the main inded page */
            .header{
                grid-area: header;
                grid-column: 1 / 3;
                padding: .5% .5% .5% 0;
                margin: .5% .5% 0 0;
            }  
            .subheader{
                grid-area: subheader;
                grid-column: 1 / 3;
                padding: .5% .5% .5% 0;
                margin: 0 .5% .5% 0;
            }
            .public-files{
                grid-area: public-files;
                padding: .5% .5% .5% 0;
            }

            .supporting-files{
                grid-area: supporting-files;
                padding: .5% .5% .5% 0;
            }
            .grader-notes{
                grid-area: grader-notes;
                padding: .5% .5% .5% 0;
            }
            .grid-layout{
                border-top: thin dashed navy;
                display: inline-grid;
                grid-template-columns: 25% 25% 50%;
                grid-template-areas: "header header header" "subheader subheader subheader"
                    "public-files supporting-files grader-notes"; 
                padding: 2% .5% 2% 0;
                width: 100%;    
            }
        </style>
    </head>

    <body>
        <figure class="right small">
            <img alt="image" src="family.JPG">
            <figcaption>My mom, my little sister and I circa 2007.</figcaption>
        </figure>

        <h1>CS 148<em>A</em> Fall 2021</h1>
        <h2>Lucía Carrera's Site map</h2>
        <p><a href="ADMIN/admin.php">My Admin Folder</a></p>
        <p><a href="ADMIN/table-viewer.php?getDatabase=">Table viewer</a></p>


        <section class="grid-layout">
            <h2 class="header">Lab four</h2>
            <p class="subheader">Display Records</p>
            <section class="public-files">
                <h3>Public Files</h3>
                <p><a href="live-lab4/index.php">index.php</a></p>
                <p><a href="live-lab4/about.php">about.php</a></p> 
                <p><a href="live-lab4/contact.php">contact.php</a></p> 
                <p><a href="live-lab4/admin.php">admin.php</a></p> 
            </section>

            <section class="supporting-files">
                <h3>Supporting files</h3>
                <p><a href="//github.com/cs-148-Fall-2021/Lab-4-Lucia-Carrera">GitHub Repo</a> </p>
                <p><a href="live-lab4/images/wildlife-records.png">wildlife records</a> </p>
                <p><a href="live-lab4/images/wildlife-query.png">wildlife query</a> </p>
                <p><a href="live-lab4/gitcommands.txt">git commands</a> </p>
                <p><a href="live-lab4/sql.php">sql commands</a> </p>

                <p><a href="live-lab4/css/custom.css">custom.css</a> </p>
                <p><a href="live-lab4/css/tablet.css">custom tablet.css</a> </p>
                <p><a href="live-lab4/css/phone.css">custom phone.css</a> </p>
            
                <p><a href="live-lab4/top.php">top.php</a></p>
                <p><a href="live-lab4/header.php">header.php</a></p>
                <p><a href="live-lab4/nav.php">nav.php</a></p>
                <p><a href="live-lab4/footer.php">footer.php</a></p>
            </section>

            <section class="grader-notes">
                <h3>Notes to grader</h3>
                <p>Acuerdate de meter el mensaje de submit </p>
            </section>
        </section>

        <section class="grid-layout">
            <h2 class="header">Lab three</h2>
            <p class="subheader">Display Records</p>
            <section class="public-files">
                <h3>Public Files</h3>
                <p><a href="live-lab3/index.php">index.php</a></p>
                <p><a href="live-lab3/about.php">about.php</a></p> 
                <p><a href="live-lab3/contact.php">contact.php</a></p> 
                <p><a href="live-lab3/admin.php">admin.php</a></p> 
            </section>

            <section class="supporting-files">
                <h3>Supporting files</h3>
                <p><a href="//github.com/cs-148-Fall-2021/Lab-3-Lucia-Carrera">GitHub Repo</a> </p>
                <p><a href="live-lab3/images/wildlife-records.png">wildlife records</a> </p>
                <p><a href="live-lab3/images/wildlife-query.png">wildlife query</a> </p>
                <p><a href="live-lab3/gitcommands.txt">git commands</a> </p>
                <p><a href="live-lab3/sql.php">sql commands</a> </p>

                <p><a href="live-lab3/css/custom.css">custom.css</a> </p>
                <p><a href="live-lab3/css/tablet.css">custom tablet.css</a> </p>
                <p><a href="live-lab3/css/phone.css">custom phone.css</a> </p>
            
                <p><a href="live-lab3/top.php">top.php</a></p>
                <p><a href="live-lab3/header.php">header.php</a></p>
                <p><a href="live-lab3/nav.php">nav.php</a></p>
                <p><a href="live-lab3/footer.php">footer.php</a></p>
            </section>

            <section class="grader-notes">
                <h3>Notes to grader</h3>
                <p>I have a pesky error I can't find</p>
            </section>
        </section>


        <section class="grid-layout">
            <h2 class="header">Lab two</h2>
            <p class="subheader">Display Records</p>
            <section class="public-files">
                <h3>Public Files</h3>
                <p><a href="live-lab2/index.php">index.php</a></p>
                <p><a href="live-lab2/about.php">about.php</a></p> 
                <p><a href="live-lab2/contact.php">contact.php</a></p> 
                <p><a href="live-lab2/admin.php">admin.php</a></p> 
            </section>

            <section class="supporting-files">
                <h3>Supporting files</h3>
                <p><a href="//github.com/cs-148-Fall-2021/Lab-2-Lucia-Carrera">GitHub Repo</a> </p>
                <p><a href="live-lab2/images/wildlife-records.png">wildlife records</a> </p>
                <p><a href="live-lab2/images/wildlife-query.png">wildlife query</a> </p>
                <p><a href="live-lab2/gitcommands.txt">git commands</a> </p>
                <p><a href="live-lab2/sql.php">sql commands</a> </p>

                <p><a href="live-lab2/css/custom.css">custom.css</a> </p>
                <p><a href="live-lab2/css/tablet.css">custom tablet.css</a> </p>
                <p><a href="live-lab2/css/phone.css">custom phone.css</a> </p>
            
                <p><a href="live-lab2/top.php">top.php</a></p>
                <p><a href="live-lab2/header.php">header.php</a></p>
                <p><a href="live-lab2/nav.php">nav.php</a></p>
                <p><a href="live-lab2/footer.php">footer.php</a></p>
            </section>

            <section class="grader-notes">
                <h3>Notes to grader</h3>
                <p>This lab was much more easy to set up but my .gitignore is still not working properly. The file .user.ini does not bother anymore, instead it's .pass.php. 
                    I've triple checked the .gitignore and still do not understand what the problem might be. I will ask about this in class.</p>
            </section>
        </section>


        <section class="grid-layout">
            <h2 class="header">Lab one</h2>
            <p class="subheader">Fingers crossed the links work!</p>
            <section class="public-files">
                <h3>Public Files</h3>
                <p><a href="live-lab1/index.php">index.php</a></p>
                <p><a href="live-lab1/about.php">about.php</a></p> 
                <p><a href="live-lab1/contact.php">contact.php</a></p> 
                <p><a href="live-lab1/admin.php">admin.php</a></p> 
            </section>

            <section class="supporting-files">
                <h3>Supporting files</h3>
                <p><a href="//github.com/cs-148-Fall-2021/Lab-1-Lucia-Carrera">GitHub Repo</a> </p>
                <p><a href="live-lab1/gitcommands.txt">git commands</a> </p>

                <p><a href="live-lab1/css/custom.css">custom.css</a> </p>
                <p><a href="live-lab1/css/tablet.css">custom tablet.css</a> </p>
                <p><a href="live-lab1/css/phone.css">custom phone.css</a> </p>
            
                <p><a href="live-lab1/top.php">top.php</a></p>
                <p><a href="live-lab1/header.php">header.php</a></p>
                <p><a href="live-lab1/nav.php">nav.php</a></p>
                <p><a href="live-lab1/footer.php">footer.php</a></p>
            </section>

            <section class="grader-notes">
                <h3>Notes to grader</h3>
                <p>I was so confused by this lab. First I did not understand how the sftp worked, 
                    then why my php code did not appear. I really wish I had started earlier to ask everything in the Friday
                     lab session and although having a day off was fun, the office hours on Labor's Day would have been a lifesaver. Hope 
                     everything works now and I am a bit disappointed I did not have enough time to make my own css.
                    <br><br>Furthermore, the nav.php, footer.php and header.php get errors when I validate them, but it is the exact same code as Bob's. 
                I have assumed that because they are "parts" of a bigger document the errors make sense. If not, I will fix the mistakes for next lab.</p>
            </section>
        </section>
        
    </body>
</html>

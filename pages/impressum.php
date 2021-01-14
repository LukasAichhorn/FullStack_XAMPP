<?php
// all includes and requires
include "../Dir-Config.php";
require "../classes/DBManager.class.php";
require "../classes/Post.class.php";
require "../classes/User.class.php";
require "../classes/UserManager.class.php";
require "../classes/validator.class.php";
require "../classes/NotificationHandler.class.php";
?>



<?php
//instantiate UserManager
$DB = new DBManager();
$DB->connectDB();

$UserManager = new UserManager();
$UserManager->startSession();
$UserManager->handleLogin($DB);
$nM=new NotificationHandler();
$nM->initAlerts();
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Open+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <title>GoellHorn</title>
</head>

<body>

  <!-- +++++++++++++++++++++++++++++++  Navigation +++++++++++++++++++++++++++++++++++ -->
  <?php include "../components/navigationBar.comp.php" ?>

  <div class="alertContainer">
    <?php $nM->display(); ?>
</div>

  <div class="container-fluid">
    <div class="row Impressum-BG size-adjust"></div>
    <div class="row">
      <div class="col">

      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-4 minusTop">     
            <h1 class="mb-3">Impressum</h1>

        

        
<p class="">Informationspflicht laut §5 E-Commerce Gesetz, §14 Unternehmensgesetzbuch, §63 Gewerbeordnung und Offenlegungspflicht laut §25 Mediengesetz.</p>
<p class="">
<p>Lukas Aichhorn und Johannes Gölles</p>
<p class="">Musterstrasse 1, Stiege 1 Tür 1, <br />1234 Musterhausen, <br />Österreich</p>
<p class="">
<strong>Tel.:</strong> 01234/56789<br />
<strong>Fax:</strong> 01234/56789-0<br />
<strong>E-Mail:</strong> <a href="mailto:office@goellHorn.com">office@goellHorn.com</a>
</p>
<p style="margin-top:15px">Quelle: Erstellt mit dem Impressum Generator von <a href="https://www.adsimple.at/" title="AdSimple® Online Marketing und Webdesign" rel="follow noopener" target="_blank">AdSimple®</a> in Kooperation mit <a href="https://www.meinhaushalt.at/" target="_blank" rel="follow noopener">meinhaushalt.at</a>
</p>
<h6 id="eu-streitschlichtung" class="">EU-Streitschlichtung</h6>
<p>Gemäß Verordnung über Online-Streitbeilegung in Verbraucherangelegenheiten (ODR-Verordnung) möchten wir Sie über die Online-Streitbeilegungsplattform (OS-Plattform) informieren.<br />
Verbraucher haben die Möglichkeit, Beschwerden an die Online Streitbeilegungsplattform der Europäischen Kommission unter <a class="" href="https://ec.europa.eu/consumers/odr/main/index.cfm?event=main.home2.show&lng=DE" target="_blank" rel="noopener">http://ec.europa.eu/odr?tid=</a> zu richten. Die dafür notwendigen Kontaktdaten finden Sie oberhalb in unserem Impressum.</p>
<p>Wir möchten Sie jedoch darauf hinweisen, dass wir nicht bereit oder verpflichtet sind, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.</p>
<h6 id="haftung-fuer-inhalte-dieser-webseite" class="">Haftung für Inhalte dieser Webseite</h6>
<p>Wir entwickeln die Inhalte dieser Webseite ständig weiter und bemühen uns korrekte und aktuelle Informationen bereitzustellen. Leider können wir keine Haftung für die Korrektheit aller Inhalte auf dieser Webseite übernehmen, speziell für jene die seitens Dritter bereitgestellt wurden.</p>
<p>Sollten Ihnen problematische oder rechtswidrige Inhalte auffallen, bitten wir Sie uns umgehend zu kontaktieren, Sie finden die Kontaktdaten im Impressum.</p>
<h6 id="haftung-links-webseite" class="">Haftung für Links auf dieser Webseite</h6>
<p>Unsere Webseite enthält Links zu anderen Webseiten für deren Inhalt wir nicht verantwortlich sind. Haftung für verlinkte Websites besteht laut <a class="" href="https://www.ris.bka.gv.at/Dokument.wxe?Abfrage=Bundesnormen&Dokumentnummer=NOR40025813&tid=" target="_blank" rel="noopener">§ 17 ECG</a> für uns nicht, da wir keine Kenntnis rechtswidriger Tätigkeiten hatten und haben, uns solche Rechtswidrigkeiten auch bisher nicht aufgefallen sind und wir Links sofort entfernen würden, wenn uns Rechtswidrigkeiten bekannt werden.</p>
<p>Wenn Ihnen rechtswidrige Links auf unserer Website auffallen, bitten wir Sie uns zu kontaktieren, Sie finden die Kontaktdaten im Impressum.</p>
<h6 id="urheberrechtshinweis" class="">Urheberrechtshinweis</h6>
<p>Alle Inhalte dieser Webseite (Bilder, Fotos, Texte, Videos) unterliegen dem Urheberrecht. Falls notwendig, werden wir die unerlaubte Nutzung von Teilen der Inhalte unserer Seite rechtlich verfolgen.</p>
<p>Sollten Sie auf dieser Webseite Inhalte finden, die das Urheberrecht verletzen, bitten wir Sie uns zu kontaktieren.</p>
<h6 id="bildernachweis" class="">Bildernachweis</h6>
<p>Die Bilder, Fotos und Grafiken auf dieser Webseite sind urheberrechtlich geschützt.</p>

<p> Illustrations by <a href="https://dribbble.com/muratkalkavan">Murat Kalkavan</a> from <a href="https://icons8.com/">Icons8</a></p>

<h1 class="">Datenschutzerklärung</h1>
<h6 id="datenschutz" class="">Datenschutz</h6>
<p>Wir haben diese Datenschutzerklärung (Fassung 01.01.1970-) verfasst, um Ihnen gemäß der Vorgaben der <a class="" href="https://eur-lex.europa.eu/legal-content/DE/ALL/?uri=celex%3A32016R0679&tid=" target="_blank" rel="noopener">Datenschutz-Grundverordnung (EU) 2016/679</a> zu erklären, welche Informationen wir sammeln, wie wir Daten verwenden und welche Entscheidungsmöglichkeiten Sie als Besucher dieser Webseite haben.</p>
<p>Leider liegt es in der Natur der Sache, dass diese Erklärungen sehr technisch klingen, wir haben uns bei der Erstellung jedoch bemüht die wichtigsten Dinge so einfach und klar wie möglich zu beschreiben.</p>
<h6 id="speicherung-persoenlicher-daten" class="">Speicherung persönlicher Daten</h6>
<p>Persönliche Daten, die Sie uns auf dieser Website elektronisch übermitteln, wie zum Beispiel Name, E-Mail-Adresse, Adresse oder andere persönlichen Angaben im Rahmen der Übermittlung eines Formulars oder Kommentaren im Blog, werden von uns gemeinsam mit dem Zeitpunkt und der IP-Adresse nur zum jeweils angegebenen Zweck verwendet, sicher verwahrt und nicht an Dritte weitergegeben.</p>
<p>Wir nutzen Ihre persönlichen Daten somit nur für die Kommunikation mit jenen Besuchern, die Kontakt ausdrücklich wünschen und für die Abwicklung der auf dieser Webseite angebotenen Dienstleistungen und Produkte. Wir geben Ihre persönlichen Daten ohne Zustimmung nicht weiter, können jedoch nicht ausschließen, dass diese Daten beim Vorliegen von rechtswidrigem Verhalten eingesehen werden.</p>
<p>Wenn Sie uns persönliche Daten per E-Mail schicken – somit abseits dieser Webseite – können wir keine sichere Übertragung und den Schutz Ihrer Daten garantieren. Wir empfehlen Ihnen, vertrauliche Daten niemals unverschlüsselt per E-Mail zu übermitteln.</p>
<h6 id="rechte-dsgvo" class="">Rechte laut Datenschutzgrundverordnung</h6>
<p>Ihnen stehen laut den Bestimmungen der DSGVO und des österreichischen <a class="" href="https://www.ris.bka.gv.at/GeltendeFassung.wxe?Abfrage=Bundesnormen&Gesetzesnummer=10001597&tid=" target="_blank" rel="noopener">Datenschutzgesetzes (DSG)</a> grundsätzlich die folgende Rechte zu:</p>
<ul class="">
<li class="">Recht auf Berichtigung (Artikel 16 DSGVO)</li>
<li class="">Recht auf Löschung („Recht auf Vergessenwerden“) (Artikel 17 DSGVO)</li>
<li class="">Recht auf Einschränkung der Verarbeitung (Artikel 18 DSGVO)</li>
<li class="">Recht auf Benachrichtigung – Mitteilungspflicht im Zusammenhang mit der Berichtigung oder Löschung personenbezogener Daten oder der Einschränkung der Verarbeitung (Artikel 19 DSGVO)</li>
<li class="">Recht auf Datenübertragbarkeit (Artikel 20 DSGVO)</li>
<li class="">Widerspruchsrecht (Artikel 21 DSGVO)</li>
<li class="">Recht, nicht einer ausschließlich auf einer automatisierten Verarbeitung — einschließlich Profiling — beruhenden Entscheidung unterworfen zu werden (Artikel 22 DSGVO)</li>
</ul>
<p>Wenn Sie glauben, dass die Verarbeitung Ihrer Daten gegen das Datenschutzrecht verstößt oder Ihre datenschutzrechtlichen Ansprüche sonst in einer Weise verletzt worden sind, können Sie sich bei der Aufsichtsbehörde beschweren, welche in Österreich die Datenschutzbehörde ist, deren Webseite Sie unter <a class="" href="https://www.dsb.gv.at/?tid=">https://www.dsb.gv.at/</a> finden.</p>
<h6 id="google-fonts-datenschutzerklaerung" class="">Google Fonts Datenschutzerklärung</h6>
<p>Auf unserer Website verwenden wir Google Fonts. Das sind die “Google-Schriften” der Firma Google Inc. Für den europäischen Raum ist das Unternehmen Google Ireland Limited (Gordon House, Barrow Street Dublin 4, Irland) für alle Google-Dienste verantwortlich.</p>
<p>Für die Verwendung von Google-Schriftarten müssen Sie sich nicht anmelden bzw. ein Passwort hinterlegen. Weiters werden auch keine Cookies in Ihrem Browser gespeichert. Die Dateien (CSS, Schriftarten/Fonts) werden über die Google-Domains fonts.googleapis.com und fonts.gstatic.com angefordert. Laut Google sind die Anfragen nach CSS und Schriften vollkommen getrennt von allen anderen Google-Diensten. Wenn Sie ein Google-Konto haben, brauchen Sie keine Sorge haben, dass Ihre Google-Kontodaten, während der Verwendung von Google Fonts, an Google übermittelt werden. Google erfasst die Nutzung von CSS (Cascading Style Sheets) und der verwendeten Schriftarten und speichert diese Daten sicher. Wie die Datenspeicherung genau aussieht, werden wir uns noch im Detail ansehen.</p>
<h6 class="">Was sind Google Fonts?</h6>
<p>Google Fonts (früher Google Web Fonts) ist ein Verzeichnis mit über 800 Schriftarten, die <a class="" href="https://de.wikipedia.org/wiki/Google_LLC?tid=">Google</a> Ihren Nutzern kostenlos zu Verfügung stellen.</p>
<p>Viele dieser Schriftarten sind unter der SIL Open Font License veröffentlicht, während andere unter der Apache-Lizenz veröffentlicht wurden. Beides sind freie Software-Lizenzen.</p>
<h6 class="">Warum verwenden wir Google Fonts auf unserer Webseite?</h6>
<p>Mit Google Fonts können wir auf der eigenen Webseite Schriften nutzen, und müssen sie nicht auf unserem eigenen Server hochladen. Google Fonts ist ein wichtiger Baustein, um die Qualität unserer Webseite hoch zu halten. Alle Google-Schriften sind automatisch für das Web optimiert und dies spart Datenvolumen und ist speziell für die Verwendung bei mobilen Endgeräten ein großer Vorteil. Wenn Sie unsere Seite besuchen, sorgt die niedrige Dateigröße für eine schnelle Ladezeit. Des Weiteren sind Google Fonts sichere Web Fonts. Unterschiedliche Bildsynthese-Systeme (Rendering) in verschiedenen Browsern, Betriebssystemen und mobilen Endgeräten können zu Fehlern führen. Solche Fehler können teilweise Texte bzw. ganze Webseiten optisch verzerren. Dank des schnellen Content Delivery Network (CDN) gibt es mit Google Fonts keine plattformübergreifenden Probleme. Google Fonts unterstützt alle gängigen Browser (Google Chrome, Mozilla Firefox, Apple Safari, Opera) und funktioniert zuverlässig auf den meisten modernen mobilen Betriebssystemen, einschließlich Android 2.2+ und iOS 4.2+ (iPhone, iPad, iPod). Wir verwenden die Google Fonts also, damit wir unser gesamtes Online-Service so schön und einheitlich wie möglich darstellen können.</p>
<h6 class="">Welche Daten werden von Google gespeichert?</h6>
<p>Wenn Sie unsere Webseite besuchen, werden die Schriften über einen Google-Server nachgeladen. Durch diesen externen Aufruf werden Daten an die Google-Server übermittelt. So erkennt Google auch, dass Sie bzw. Ihre IP-Adresse unsere Webseite besucht. Die Google Fonts API wurde entwickelt, um Verwendung, Speicherung und Erfassung von Endnutzerdaten auf das zu reduzieren, was für eine ordentliche Bereitstellung von Schriften nötig ist. API steht übrigens für „Application Programming Interface“ und dient unter anderem als Datenübermittler im Softwarebereich.</p>
<p>Google Fonts speichert CSS- und Schrift-Anfragen sicher bei Google und ist somit geschützt. Durch die gesammelten Nutzungszahlen kann Google feststellen, wie gut die einzelnen Schriften ankommen. Die Ergebnisse veröffentlicht Google auf internen Analyseseiten, wie beispielsweise Google Analytics. Zudem verwendet Google auch Daten des eigenen Web-Crawlers, um festzustellen, welche Webseiten Google-Schriften verwenden. Diese Daten werden in der BigQuery-Datenbank von Google Fonts veröffentlicht. Unternehmer und Entwickler nützen das Google-Webservice BigQuery, um große Datenmengen untersuchen und bewegen zu können.</p>
<p>Zu bedenken gilt allerdings noch, dass durch jede Google Font Anfrage auch Informationen wie Spracheinstellungen, IP-Adresse, Version des Browsers, Bildschirmauflösung des Browsers und Name des Browsers automatisch an die Google-Server übertragen werden. Ob diese Daten auch gespeichert werden, ist nicht klar feststellbar bzw. wird von Google nicht eindeutig kommuniziert.</p>
<h6 class="">Wie lange und wo werden die Daten gespeichert?</h6>
<p>Anfragen für CSS-Assets speichert Google einen Tag lang auf seinen Servern, die hauptsächlich außerhalb der EU angesiedelt sind. Das ermöglicht uns, mithilfe eines Google-Stylesheets die Schriftarten zu nutzen. Ein Stylesheet ist eine Formatvorlage, über die man einfach und schnell z.B. das Design bzw. die Schriftart einer Webseite ändern kann.</p>
<p>Die Font-Dateien werden bei Google ein Jahr gespeichert. Google verfolgt damit das Ziel, die Ladezeit von Webseiten grundsätzlich zu verbessern. Wenn Millionen von Webseiten auf die gleichen Schriften verweisen, werden sie nach dem ersten Besuch zwischengespeichert und erscheinen sofort auf allen anderen später besuchten Webseiten wieder. Manchmal aktualisiert Google Schriftdateien, um die Dateigröße zu reduzieren, die Abdeckung von Sprache zu erhöhen und das Design zu verbessern.</p>
<h6 class="">Wie kann ich meine Daten löschen bzw. die Datenspeicherung verhindern?</h6>
<p>Jene Daten, die Google für einen Tag bzw. ein Jahr speichert können nicht einfach gelöscht werden. Die Daten werden beim Seitenaufruf automatisch an Google übermittelt. Um diese Daten vorzeitig löschen zu können, müssen Sie den Google-Support auf <a class="" href="https://support.google.com/?hl=de&tid=">https://support.google.com/?hl=de&tid=</a> kontaktieren. Datenspeicherung verhindern Sie in diesem Fall nur, wenn Sie unsere Seite nicht besuchen.</p>
<p>Anders als andere Web-Schriften erlaubt uns Google uneingeschränkten Zugriff auf alle Schriftarten. Wir können also unlimitiert auf ein Meer an Schriftarten zugreifen und so das Optimum für unsere Webseite rausholen. Mehr zu Google Fonts und weiteren Fragen finden Sie auf <a class="" href="https://developers.google.com/fonts/faq?tid=">https://developers.google.com/fonts/faq?tid=</a>. Dort geht zwar Google auf datenschutzrelevante Angelegenheiten ein, doch wirklich detaillierte Informationen über Datenspeicherung sind nicht enthalten. Es ist relativ schwierig, von Google wirklich präzise Informationen über gespeicherten Daten zu bekommen.</p>
<p>Welche Daten grundsätzlich von Google erfasst werden und wofür diese Daten verwendet werden, können Sie auch auf <a class="" href="https://policies.google.com/privacy?hl=de&tid=">https://www.google.com/intl/de/policies/privacy/</a> nachlesen.</p>
<p style="margin-top:15px">Quelle: Erstellt mit dem Datenschutz Generator von <a href="https://www.adsimple.at/linkbuilding-backlinkaufbau/" title="AdSimple® Linkbuiling" rel="follow noopener" target="_blank">AdSimple® Linkbuilding</a> in Kooperation mit <a href="https://www.meinhaushalt.at/" target="_blank" rel="follow noopener">meinhaushalt.at</a>
</p>
      
      
        
            
         
        </div>
        

      

      <div class="col">

      </div>
    </div>
  </div>













  <?php require "../components/JS_Imports.comp.php" ?>
    
</body>

</html>
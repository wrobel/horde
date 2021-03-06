��          �      \      �  h  �  z  :  �  �  �   u    S	     m     �  ~  �  $     r   ?  S   �  9     �  @     �  /     4   @     u  h   �  8   �  �  7  d  �  X  -  u  �  �   �  =  �     6     V  T  q  /   �  z   �  [   q  6   �  �        �   )   �   '   �   '   !  n   ?!  K   �!                                       
                	                                              data - Handle Kolab data (the default action is "info"). PATH refers to the path of the folder that holds the data and the optional TYPE argument indicates which data type should be read. This is usually already defined by the folder setting.

  - info      PATH  : Display general information.
  - stamp     PATH  : Display the folder status information.


   folder - Handle a single folder (the default action is "show")

  - show      PATH         : Display information about the folder at PATH.
  - create    PATH [TYPE]  : Create the folder PATH (with the optional type TYPE).
  - delete    PATH         : Delete the folder PATH.
  - rename    OLD NEW      : Rename the folder from OLD to NEW.
  - getacl    PATH         : Get all ACL on the specified folder.
  - getmyacl  PATH         : Get your ACL on the specified folder.
  - setacl    PATH USER ACL: Set the ACL for the specified user on the folder.
  - deleteacl PATH USER ACL: Delete the ACL for the specified user on the folder.
  - getdesc   PATH         : Return the share description of the specified folder.
  - setdesc   PATH DESC    : Set the share description of the specified folder to DESC.
  - getshare  PATH         : Return the share parameters of the specified folder.


   format - Handle the Kolab format (the default action is "read")

  - read TYPE [FILE|FOLDER UID PART]: Read a Kolab format file of the specified
                                      type. Specify either a direct file name
                                      or a combination of an IMAP folder, a UID
                                      within that folder and the specific part
                                      that should be parsed.


   ledger - Handle ledger data in a Kolab backend (the default action is "display").

  - display            : Display all ledgers.
  - import FOLDER FILE : Import ledger XML data stored in FILE into Kolab folder FOLDER.

   list - Handle folder lists (the default action is "folders")

  - folders          : List the folders in the backend
  - types            : Display all folders that have a folder type.
  - type TYPE        : Display the folders of type TYPE.
  - owners           : List all folders and their owners.
  - defaults         : List the default folders for all users.
  - aclsupport       : Display if the server supports ACL.
  - namespace        : Display the server namespace information.
  - sync             : Synchronize the cache.


 %s is no local file! Action %s not supported! Activates the IMAP debug log. This will log the full IMAP communication - CAUTION: the "php" driver is the only driver variant that does not support this feature. For most drivers you should use "STDOUT" which will direct the debug log to your screen. For the horde, the horde-php, and the roundcube drivers you may also set this to a filename and the output will be directed there. Deactivate caching of the IMAP data. Produce time measurements to indicate how long the processing takes. You *must* activate logging for this as well. Report memory consumption statistics. You *must* activate logging for this as well. Sets the connection type. Use either "tls" or "ssl" here. The Kolab backend driver that should be used.
Choices are:

 - horde     [IMAP]: The Horde_Imap_Client driver as pure PHP implementation.
 - horde-php [IMAP]: The Horde_Imap_Client driver based on c-client in PHP
 - php       [IMAP]: The PHP imap_* functions which are based on c-client
 - pear      [IMAP]: The PEAR-Net_IMAP driver
 - roundcube [IMAP]: The roundcube IMAP driver
 - mock      [Mem.]: A dummy driver that uses memory. The host that holds the data. The password of the user accessing the backend. The port that should be used to connect to the host. The user accessing the backend. Write a log file in the provided LOG location. Use "STDOUT" here to direct the log output to the screen. [options] MODULE ACTION

Possible MODULEs and ACTIONs:

 Project-Id-Version: Horde_Kolab_Cli 
Report-Msgid-Bugs-To: dev@lists.horde.org
POT-Creation-Date: 2011-03-26 21:38+0100
PO-Revision-Date: 2011-04-03 11:08:14+0300
Last-Translator: Leena Heino <liinu@uta.fi>
Language-Team: Finnish <i18n@lists.horde.org>
Language: fi
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8-bit
Plural-Forms: nplurals=2; plural=(n != 1);
   tieto - Käsittele Kolav tietoja (oletustoiminto on "info"). Polku tarkoittaa polkua kansioon, jossa tiedot sijaitsee ja valinnaista TYYPPI argumenttia, joka tarkoittaa mitä tietoja pitäisi lukea. Tämä on yleensä määritelty kansion asetuksissa.

  - info      POLKU  : Näytä yleiset tiedot.
  - stamp     POLKU  : Näytä kansion tilatietdot.


  kansio - Käsittele yhtä kansiota (oletustoiminto on "show")

  - show      POLKU         : Näyttää POLUN osoittaman kansion tiedot.
  - create    POLKU [TYYP]  : Luo kansion POLKUUN (valinnaisella TYYPillä)
  - delete    POLKU         : Poistaa POLUN osoittaman kansion.
  - rename    UUSI VANHA    : Nimeää VANHA UUSI nimelle.
  - getacl    POLKU         : Hae kansion ACL tiedot.
  - getmyacl  POLKU         : Hae kansion omat ACL tiedot.
  - setacl    POLKU KÄYT ACL: Aseta KÄYTTÄJÄN ACL tiedot POLUN osoittamaan
kansioon.
  - deleteacl POLKU KÄYT ACL: Poista KÄYTTÄJÄN ACL tiedot POLUN osoittamasta
kansiosta.
  - getdesc   POLKU         : Palauta POLUN osoittaman kansion kuvaus.
  - setdesc   POLKU KUVAUS  : Aseta KUVAUS POLUN osoittamaan kansioon.
  - getshare  POLKU         : Palauttaa POLUN osoittaman kansion jaon parametrit.

   format - Käsittelee Kolab formaattia (oletustoiminto on "read")

  - read TYYP [TIED|KANSIO UID OSIO]: Lukee Kolab formatoidun tiedoston                                       tyyppiä TYYP. Määrittele joko tiedosto                                       tai IMAP kansio ja viestin UID ja                                       viestin osio, joka pitäisi käsitellä.


   ledger - Käsittelee ledger tietoja Kolab taustajärjestelmässä oletustoiminto on "display").

  - display            : Näyttää kaikki ledgerit.
  - import KANSIO TIED : Tuo ledger XML datan talletettuna tiedostoon TIED Kolab kansioon KANSIO.

   list - Käsittelee kansiolistauksia (oletustoiminto on "folders")

  - folders          : Listaa kansiot taustajärjestelmästä.
  - types            : Näyttää kaikki ne kansioit, joilla on kansiotyyppi.
  - type TYYPPI      : Näyttää TYYPPI muotoa olevat kansiot.
  - owners           : Listaa kaikki kansiot ja niiden omistajat.
  - defaults         : Listaa oletuskansion kaikille käyttäjille.
  - aclsupport       : Näyttää jos palvelin tukee ACL.
  - namespace        : Näyttää palvelin nimiavaruudet.
  - sync             : Synkronoi välimuistin.


 %s ei ole paikallinen tiedosto! Toiminto %s ei ole tuettu! Aktivoi IMAP debug lokin. Tämä loki sisältää kaikki IMAP yhteyden tiedot - VAROITUS: "php" ajuri on ainoa joka tukee tätä toimintoa. Muilla ajureilla sinun tulisi käyttää "STDOUT", joka ohjaa debug lokin ruudulle. Ajureille horde, horde-php ja rouncube voi asettaa tämän osoittamaan tiedostoon ja kaikki tulostus ohjataan sinne. Poista käytöstä IMAP tietojen välimuistitus Tuota aikamittauksen siitä kuin paljon jokin toiminto kestää. Tämän lisäksi sinun *pitää* aktivoida myös lokitus. Raportoi muistinkäyttötilastot. Tämän lisäksi sinun *pitää* aktivoida myös lokitus. Asettaa yhteyden tyypin. Käytä joko "tls" tai "ssl". Käyttöön otettava Kolab taustajärjestelmäajuri.
Vaihtoehdot ovat:

 - horde     [IMAP]: Horde_Imap_Client ajuri, pelkkä PHP toteutus. - horde-php [IMAP]: Horde_Imap_Client ajuri perustuen c-client ja PHP
 - php       [IMAP]: PHP:n imap_* funktiot, jotka perustuu c-client
 - pear      [IMAP]: PEAR-Net_IMAP ajuri
 - roundcube [IMAP]: Roundcupe IMAP ajuri
 - mock      [Mem.]: Tynkä muistia käyttävä ajuri. Palvelin jossa tiedot sijaitsee. Taustajärjestelmäkäyttäjän salasana. Palvelimen portti, johon yhteys otetaan Taustajärjestelmän käyttäjätunnus. Kirjoita loki tiedostoon määriteltyyn LOG paikkaan. Käytä "STDOUT" ohjataksesi lokin tulostumaan ruudulle. [optiot] MODUULI TOIMINTO

Käytettävissä olevat MODUULIT ja TOIMINNOT:

 
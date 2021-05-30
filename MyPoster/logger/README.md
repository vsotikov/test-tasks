# Implementiere die Basis-Struktur für einen Logger. Der Logger soll dann in der Klasse "AsciiArray" genutzt werden.

Anforderungen:
- Der Logger soll verschiedene Prioritäten unterstützen
- Eine Exception soll mit mehr Informationen geloggt werden, als die normalen Log-Einträge (siehe Klasse "AsciiArray")
- Für jeden Log-Eintrag soll zusätzlich die aktuelle Uhrzeit und Priorität mitgespeichert werden.
- Der Logger soll mindestens zwei verschiedene Speicherarten unterstützen, z.B. Datenbank und Filesystem.
- Der Logger soll zur Laufzeit nur eine der beiden Speicherarten verwenden
- Das Abspeichern selbst muss nicht implementiert werden (Testen ob Datenbank/Datei existiert usw.).
- Die Funktionalität des Loggers soll durch PHPUnit Tests abgedeckt sein. Die Speicherarten müssen nicht getestet
  werden, da deren Implementierung nicht notwendig ist.
- Die Grundprinzipien von OOP sollen eingehalten werden.

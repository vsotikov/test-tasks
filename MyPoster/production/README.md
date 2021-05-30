# Die Zustände von zwei Artikeln in der Produktion sollen verwaltet werden.

Zwei Artikel sind vorgegeben:
- Gerahmtes Poster
- Bedruckte Glasplatte

Beide Artikel können jeweils mit und ohne "Geschenkverpackung" bestellt werden.

Die Produktion des "Gerahmten Posters" umfasst folgende Zustände:
1. ordered
2. printed
3. sliced
4. framed
5. gift-wrapped (optional)
6. shipped

Die Produktion der "Bedruckten Glasplatte" umfasst folgende Zustände:
1. ordered
2. printed
3. gift-wrapped (optional)
4. shipped

Wichtig ist, dass die korrekte Reihenfolge der Zustände sichergestellt wird.

Die Artikel werden manuell von einem Schritt zum nächsten befördert, wodurch es vorkommen kann, dass ein Artikel einen falschen Zustand erhält.
Hier wird erwartet, dass eine entsprechende Fehlermeldung mit dem erwarteten Zustand ausgegeben wird.
Solche Fehler sind in der Datei run.php bereits vorgesehen.

Anforderungen:
- Für die Umsetzung soll kein Framework/Bibliothek verwendet werden.
- Es ist keine Graphische Oberfläche nötig (Ein CLI Programm reicht aus).
- Am Artikel soll nachvollziehbar sein, wann (genaue Zeit) welcher Zustand eingetreten ist.
- Wenn ein nicht erwarteter Zustand bestätigt wird, soll eine Fehlermeldung ausgegeben werden.
- Der Code soll erweiterbar sein, so das ein neuer Zustand zwischen bereits vorhandene Zustände einfach eingefügt werden kann.
- Für die Umsetzung muss der bereitgestellte Quellcode als Basis verwendet werden. Dieser darf an beliebiger Stelle erweitert werden.
- Die Datei run.php dient als Grundlage zum Testen.

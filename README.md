# Presto.it

Descrizione
Questa applicazione Laravel è una piattaforma di annunci che consente la vendita tra privati. 
Gli utenti possono inserire annunci che saranno revisionati dai Revisori che possono accettarli o rifiutarli, posso modificare i propri annunci che ritorneranno in revisione,
o richiedere di collaborare con lo Staff e quindi diventare Revisori.
I Revisori come qualsiasi altro utente, puo creare e modificare un annuncio, l'annuncio creato non entrerà in revisione ma ben si direttamente nella lista degli annnunci già 
revisionati, essendo Revisore possiede anche un'apposita pagina nella quale puo' revisionare gli annunci creati dagli utenti, che non siano Revisori o Admin.
Anche L'Admin puo creare dei contenuti per il sito, ma cosa piu importante, possiede il potere di modificare il ruolo degli User (Editor - Revisor), o eliminare l'account di un User.
L'applicazione integra Bootstrap per il front-end, Fortify per l'autenticazione, Spatie per i permessi dei ruoli dei vari utenti, e Google Vision API per l'analisi delle immagini.

Funzionalità
Inserimento e gestione degli annunci da parte degli utenti.
Revisione degli annunci da parte di revisori autorizzati.
Autenticazione e registrazione utenti con Fortify.
Login tramite social network con Socialite.
Gestione delle permessioni utente con Spatie.
Analisi immagini degli annunci con Google Vision API.
Requisiti
PHP >= 8.1
Laravel 10.x
Database MySQL

Altri requisiti specifici del progetto
Installazione

-------bash----------------------------------


*Clonare il repository
Copy code:                                                                                                                                                                                                                                                    
1. git clone [URL del repository]                                                                                                                                                                                                                                                         


*Installare le dipendenze Composer
Copy code:                                                                                                                                                                                                                                                                        
2. composer install                                                                                                                                                                                                                                                                          


*Configurare l'ambiente
Copy code                                                                                                                                                                                                                                                           
3. cp .env.example .env                                                                                                                                                                                                                                                    
(Modificare .env appena creato con il comando subito sopra, con le impostazioni del database e altre configurazioni necessarie.)


*Generare la chiave dell'applicazione
Copy code                                                                                                                                                                                                                                                           
4. php artisan key:generate                                                                                                                                                                                                                                                                                                                                 

*Eseguire le migrazioni e i seeders                                                                                                                                                                                     
Copy code                                                                            
5. php artisan migrate --seed                                                                                                                                                                                                                               


*Avvio progetto                                                                                                                                                                                                                
6-1. php artisan serve
6-2. npm run dev
6-3. php artisan queue:work
(avviati in sieme su dei terminali separati)

----------------------------------------------

Google Vision API
Passaggi per integrare e utilizzare Google Vision API nell'applicazione.
 -Reperire le credenziali di Google Vision
 -Sostituire le credenziali all'interno del file "google_credential.json", presente della Root del progetto
 
 NB Se non si inseriscono correttamente le credenziali le immagini degli annunci non verrano visualizzate. 


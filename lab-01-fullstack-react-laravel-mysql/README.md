#  Lab 01 – Déploiement d’un stack Fullstack React / Laravel / MySQL avec Docker Compose

##  Présentation du projet

Ce projet démontre le **déploiement d’un stack fullstack React / Laravel / MySQL**
à l’aide de **Docker et Docker Compose**.

L’application déployée est volontairement **simple (page d’accueil fonctionnelle)**.
L’objectif principal n’est pas la complexité fonctionnelle, mais la **méthode de déploiement**,
l’architecture conteneurisée et l’orchestration des services.

La même approche s’appliquerait à une application plus complète utilisant le même stack.

##  Objectifs techniques

- Construire une image Docker pour le frontend React
- Construire une image Docker pour le backend Laravel
- Déployer MySQL comme service Docker
- Orchestrer l’ensemble avec Docker Compose
- Assurer la communication inter-services et la persistance des données

<img width="1917" height="952" alt="homepage" src="https://github.com/user-attachments/assets/9656befc-1e78-474d-96fc-2102d41f1409" />
<img width="1917" height="976" alt="homepage1" src="https://github.com/user-attachments/assets/0243d0ba-87e5-4d83-889b-8b72006b298a" />
<img width="1450" height="457" alt="docker-up" src="https://github.com/user-attachments/assets/9f2c8cd5-521b-4143-bc1e-afd466a4ea6d" />
<img width="1462" height="467" alt="docker-up2" src="https://github.com/user-attachments/assets/f11a3b5b-82ae-45b5-8ff2-78cc34e959c0" />

---
## 🧱 Architecture

L’architecture repose sur trois services définis dans le fichier `docker-compose.yml`.

Utilisateur
│
▼
[ Frontend React ]
│
▼
[ Backend Laravel (API) ]
│
▼
[ MySQL ]


### Principes appliqués
- Un conteneur par composant
- Communication via réseau Docker interne
- Persistance des données MySQL via volume
- Architecture reproductible

---

## 🛠️ Stack technique

- Docker
- Docker Compose
- React
- Laravel
- MySQL
- Linux

---

## ⚙️ Exécution et déploiement du projet

### Prérequis
- Docker
- Docker Compose
- Git

---

### Étapes détaillées

```bash
git clone https://github.com/AbdelWahab28/docker-labs.git (1️⃣ **Cloner le repository**)

cd docker-labs/lab-01-fullstack-react-laravel-mysql 

docker build -t frontend-react:v1 ./Frontend (2️⃣ **Construire l’image du frontend React**)

docker build -t backend-laravel:v1 ./Backend (3️⃣ **Construire l’image du backend Laravel**)

docker images (4️⃣ **Vérifier les images créées**)

docker compose up -d (5️⃣ **Lancer tous les services avec Docker Compose**)

docker compose ps (6️⃣ **Vérifier que tous les conteneurs sont en cours d’exécution**)

7️⃣ **Accéder à l’application**
http://localhost:3000

## 📁 Organisation du projet
```bash
lab-01-fullstack-react-laravel-mysql/
│
├── docker-compose.yml
├── Frontend/
│   └── Dockerfile
├── Backend/
│   └── Dockerfile
└── README.md

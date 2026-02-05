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

<img width="1917" height="952" alt="homepage" src="https://github.com/user-attachments/assets/c51b162d-0356-420a-bb31-42778ac4ca28" />

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

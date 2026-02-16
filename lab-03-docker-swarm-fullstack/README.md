# Lab 03 – Déploiement Fullstack avec Docker Swarm + approche DevSecOps

## Présentation du projet

Ce projet démontre le **déploiement d’un stack Fullstack (React / Laravel / MySQL)** 
en utilisant **Docker Swarm** comme orchestrateur.

Contrairement au Lab 01 basé sur Docker Compose, ici l’objectif est de :

- Déployer les services dans un cluster Swarm
- Utiliser les services Docker au lieu de simples conteneurs
- Mettre en place une approche orientée DevSecOps
- Appliquer des bonnes pratiques d’architecture et de sécurité

L’application reste volontairement simple, l’objectif étant de maîtriser
l’orchestration et la sécurisation du déploiement.

---
<img width="1538" height="578" alt="14" src="https://github.com/user-attachments/assets/5d21a238-800b-4f77-a0ac-ac56b1f3b8bc" />

<img width="1542" height="870" alt="15" src="https://github.com/user-attachments/assets/924459ba-4390-4a95-86f6-47d13e249692" />

## Objectifs techniques

- Initialiser un cluster Docker Swarm
- Déployer le frontend React comme service
- Déployer le backend Laravel comme service
- Déployer MySQL avec volume persistant
- Mettre en place une architecture réseau interne sécurisée
- Appliquer des bonnes pratiques DevSecOps

---

## Architecture

L’architecture repose sur trois services principaux déployés dans le cluster Swarm.

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

- Orchestration via Docker Swarm
- Services répliqués (scalabilité possible)
- Réseau overlay interne
- Volume persistant pour MySQL
- Isolation des services

---

## Stack technique

- Docker
- Docker Swarm
- React
- Laravel
- MySQL
- Linux
- Overlay Network
- Trivy
- Docker Benchmark
- Falcon security

---

## Prérequis

- Docker installé
- Mode Swarm activé
- Git

---

## Initialisation du cluster Swarm

```bash
docker swarm init
docker node ls
docker build -t reactapp:v1.1 ./Frontend
docker build -t laravelapp:v1.1 ./Backend
docker stack deploy -c docker-stack.yaml appfullstack --deploy=false
docker run --rm -v /var/run/docker.sock:/var/run/docker.sock aquasec/trivy:latest image reactapp:v1.1
docker run --rm -v /var/run/docker.sock:/var/run/docker.sock aquasec/trivy:latest image laravelapp:v1.1
docker run --rm -v /var/run/docker.sock:/var/run/docker.sock aquasec/trivy:latest image mysql:8.0
git clone https://github.com/docker/docker-bench-security.git
cd docker-bench-security
sudo sh docker-bench-security.sh
nano falco-swarm.yaml
docker stack deploy -c falco-swarm.yml falco-security --detach=false
```
```bash
lab-03-docker-swarm-devsecops/
│
├── docker-stack.yml
├── Frontend/
│ └── Dockerfile
├── Backend/
│ └── Dockerfile
└── README.md
```

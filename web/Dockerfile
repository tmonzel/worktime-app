FROM node:9

# Create application directory
WORKDIR /usr/src/app

# Install application dependencies
COPY package.json ./
RUN npm install

# Bundle application source
COPY server.js ./

EXPOSE 8080
CMD npm start
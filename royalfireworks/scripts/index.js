import React from 'react';
import ReactDOM from 'react-dom';
import config from './config.json';
import constants from './constants.js';

import Home from './components/Home';

require('../styles/main.less');

const app = document.querySelector('.app');

ReactDOM.render(<Home config={config} constants={constants} />, app);

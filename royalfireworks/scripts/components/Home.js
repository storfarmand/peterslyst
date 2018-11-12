import React from 'react';

import * as ProductActions from '../actions/ProductActions';
import ProductStore from '../stores/ProductStore';

import * as CarttActions from '../actions/CartActions';
import CartStore from '../stores/CartStore';

import Product from './Product';

export default class Home extends React.Component {
  constructor() {
    super();
    this.state = {
      products: []
    }
  }
  componentWillMount() {
    ProductStore.on('product:bgtoggle', () => {
      this.setState({bgColor: !this.state.bgColor});
    });
  }
  componentDidMount() {
    fetch(this.props.config.endpoint,
      {
        mode: "cors"
      })
      .then(res => res.json()
      .then(json => this.setState({products: json})));
  }

  render() {
    let products = [];
    this.state.products.forEach(product => {
      products.push(
        <Product 
          key={product.p_id} 
          id={product.p_id} 
          name={product.p_name}
          desc={product.p_desc}
          price={product.p_price}
          active={product.p_active}/>)
    });
    console.log(products);
    return (
      <div className="home">
        <h2>{this.props.constants.experienceId}</h2>
        {products}
      </div>
    );
  }
}

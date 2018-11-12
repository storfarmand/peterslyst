import React from 'react';
import cx from 'classnames';

export default class Product extends React.Component {
  constructor() {
    super();
  }

  render() {
    const {name, desc, price, active} = this.props;
    return (
      <div className={cx('product', {'active': active})}>
        <h2>{name}</h2>
        <p>{desc}</p>
        <p>{price}</p>
        <button>Add to cart</button>
      </div>
    );
  }
}

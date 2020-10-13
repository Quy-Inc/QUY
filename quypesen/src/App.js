//import React, { Component } from 'react';
import React,{ useRef, useState,Component } from "react";
import ReactDOM from "react-dom";
import "react-responsive-carousel/lib/styles/carousel.min.css";
import { Carousel } from 'react-responsive-carousel';
import { Lines } from 'react-preloaders';
import Button from '@material-ui/core/Button';
import Fab from '@material-ui/core/Fab';
import AddIcon from '@material-ui/icons/Add';
import RemoveIcon from '@material-ui/icons/Remove';
import Snackbar from '@material-ui/core/Snackbar';
import IconButton from '@material-ui/core/IconButton';
import Icon from '@material-ui/core/Icon';
import NumericInput from 'react-numeric-input';
import NumberFormat from 'react-number-format';
import Stepper from 'react-stepper-primitive';
import MuiAlert from '@material-ui/lab/Alert';
import { makeStyles } from '@material-ui/core/styles';

import { Row,
   Col,
   ButtonGroup,
   ButtonToolbar,
   Card,
   Container,
   Image,
   Media,
   Toast,
   Form,
   Modal,
   Badge } from "react-bootstrap";
import 'bootstrap/dist/css/bootstrap.min.css';
import styles from './styles/App.module.css'


function LoadingPreloader() {
    return (
      <Lines />
  );
}

function Alert(props) {
  return <MuiAlert elevation={6} variant="filled" {...props} />;
}

const useStyles = makeStyles(theme => ({
  root: {
    width: '100%',
    '& > * + *': {
      marginTop: theme.spacing(2),
    },
  },
}));


function getCarousel()
{
  return (
        <Carousel>
            <div>
                <img src="http://admin.quypesen.7clue.co/public/merchant/photo/venues_5e216007b96b4352371ed552_0.jpeg" />
                <p className="legend">Legend 1</p>
            </div>
            <div>
                <img src="http://admin.quypesen.7clue.co/public/merchant/photo/venues_5e216007b96b4352371ed552_1.jpeg" />
                <p className="legend">Legend 2</p>
            </div>
            <div>
                <img src="http://admin.quypesen.7clue.co/public/merchant/photo/stores_5e21cdc8b96b432cb259d072_1.jpeg" />
                <p className="legend">Legend 3</p>
            </div>
        </Carousel>
    );
}

const stylesSnackBar = {
    root: {
      background: 'red'
    }
};

class App extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      error: null,
      isLoaded: false,
      autoplay: true,
      modalPhone: true,
      data:null,
      menus:[],
      open: false,
      vertical: 'bottom',
      horizontal: 'center',
      disabled:false,
      orderMenu:[],
      openCart:false,
      priceCart:0,
      qtyCart:[],
      phone:null,
    };


    this.checkFabHideShow = this.checkFabHideShow.bind(this);
    this.onChangeField = this.onChangeField.bind(this);
    this.setCart = this.setCart.bind(this);
    
  }
  
  
  
  checkFabHideShow = (id) =>
  {
      console.log(id);
      const {orderMenu,priceCart,openCart,qtyCart} = this.state;
      
      var fab = document.getElementById("fab"+id);
      var qtyDiv = document.getElementById("qtyDiv"+id);
      var qty = document.getElementById("qty"+id);
      var idMenu = qty.getAttribute("idMenu");
      
      var idQty = id+"qty_";
      console.log(idQty);
    
      var qtyMenu = 1;
      
      fab.style.display = 'none';
      qtyDiv.removeAttribute("hidden");   
      
      var priceMenu = qty.getAttribute("priceMenu");

     
      // Add item to it
      //newOrderMenu = new Array();
      orderMenu[id] = {"id":idMenu,"qty":qtyMenu,"uPrice":priceMenu};
      var priceCart_ = 0;  
      orderMenu.map((key,value)=>{
        //console.log(key.id)
        priceCart_ = priceCart_ + (key.uPrice * key.qty);
      })
      //console.log(priceCart_);

      var openCart_ = (priceCart_ >0)?true:false;

      this.setCart(priceCart_,openCart_);
      
       
  }

  setCart = (vPriceCart,vOpenCart) => {

    this.setState({
        priceCart:vPriceCart,
        openCart:vOpenCart
      })
  }


  onChangeField = (id) => {
    console.log(id)
    const {orderMenu,priceCart,openCart,menus,qtyCart} = this.state;
    var fab = document.getElementById("fab"+id);
    var qtyDiv = document.getElementById("qtyDiv"+id);
    var qty = document.getElementById("qty"+id);
    var qtyValue = qty.value;
    var qtyMenu = qtyValue;
    var idMenu = qty.getAttribute("idMenu");
    var priceMenu = qty.getAttribute("priceMenu");
    if(qtyValue == 0)
      {
        qtyDiv.setAttribute("hidden","");
        fab.style.display = 'inline-flex';
        orderMenu[id] = {"id":idMenu,"qty":qtyMenu,"uPrice":priceMenu};

      }else{
         orderMenu[id] = {"id":idMenu,"qty":qtyMenu,"uPrice":priceMenu};
                
         //console.log(orderMenu);
      }
     
     var priceCart_ = 0;  
     orderMenu.map((key,value)=>{
       //console.log(key.id)
       priceCart_ = priceCart_ + (key.uPrice * key.qty);
     })

     this.setCart(priceCart_,(priceCart_ > 0)?true:false);
    
  }

 


  componentDidMount() {
    fetch("http://admin.quypesen.7clue.co/api/tables/QPT00001")
      .then(res => res.json())
      .then(
        (result) => {
          this.setState({
            isLoaded: true,
            data: result,
            menus: [result.menus],
          });
        },
        // Note: it's important to handle errors here
        // instead of a catch() block so that we don't swallow
        // exceptions from actual bugs in components.
        (error) => {
          this.setState({
            isLoaded: true,
            error
          });
        }
      )
  };

  modalPhone = ()=> {
    this.setState({
      modalPhone:false,
    })
  };

  clickOTP = ()=> {
    this.setState({
      open: true,
      vertical: 'bottom',
      horizontal: 'center'
    })
  };
  
  snackBarClose = ()=> {
   this.setState({
      open: false,
    })
  };

  

  render() {
    const { error, isLoaded, data,vertical, horizontal, open, menus,openCart, priceCart } = this.state;
    //console.log(data);
    //const handleClose = () => setShow(false);
        
    if (error) {
      return <div>Error: {error.message}</div>;
    } else if (!isLoaded) {
      return <LoadingPreloader/>
    } else {

      const logo_merchant = "http://admin.quypesen.7clue.co/public/merchant/"+data.merchants.logo;

      return (            
        <Container style={{
                backgroundColor: '#ededed',
                margin:0,
                padding:0,
                }}>

          
          <Row className="justify-content-md-left">
            <Col xs={2}>
                  <img
                    width={64}
                    height={64}
                    className="mr-3"
                    src={logo_merchant}
                    alt="Merchant"
                  />
            </Col>
            <Col xs={10}>
              <Col xs={12} style={{
                  paddingTop:'8px',
                  }}>
                Selamat Datang Di,
              </Col>
              <Col xs={12}>
                <h5>
                  {data.merchants.merchant_name}
                </h5>
              </Col>
              </Col>
              <Col xs={12}>
                 <Carousel showThumbs={false} showStatus={false} showIndicators={false} infiniteLoop={true}>
                    <div>
                        <img src="http://admin.quypesen.7clue.co/public/merchant/photo/venues_5e216007b96b4352371ed552_0.jpeg" />
                    </div>
                    <div>
                        <img src="http://admin.quypesen.7clue.co/public/merchant/photo/venues_5e216007b96b4352371ed552_1.jpeg" />
                    </div>
                    <div>
                        <img src="http://admin.quypesen.7clue.co/public/merchant/photo/stores_5e21cdc8b96b432cb259d072_1.jpeg" />
                    </div>
                </Carousel>
              </Col>
          </Row>
          <Col className={styles.menuListContainer}>
           {menus[0].map((item, key) =>
          <Row className={styles.MenuList}>
            <Col xs={2}>
              <img
                width={64}
                height={64}
                className="align-self-start mr-3 rounded"
                src={"http://admin.quypesen.7clue.co/public/merchant/"+item.photos[0]['photo']}
                alt={item.photos[0]['label']}
              />
            </Col>

           

                <Col xs={10} className={styles.MenuName}>
                  <Col xs='auto'>
                  <h6>{item.menu_name}</h6>
                  <NumberFormat value={item.price}  displayType={'text'} thousandSeparator={true} renderText={value => <span>{value}</span>} />

                  </Col>
                  <Col style={{
                    paddingTop:'10px',
                    paddingRight:'0px',
                    paddingLeft: '0px',
                    textAlign:'right',
                    right:'0px',
                  }}>
                    <Fab style={{
                      backgroundColor:'#23bd6d',
                      color:'#fff'
                    }} size="small" id={"fab"+key} aria-label="add" priceMenu={item.price} onClick={e => this.checkFabHideShow(key)}>
                      <AddIcon />
                    </Fab>
                    <div hidden id={'qtyDiv'+key}>
                      <Stepper
                          min={0}
                          max={25}
                          ref={this.key+"qty_"}
                          onChange={e => this.onChangeField(key)}
                          render={({
                            getFormProps,
                            getInputProps,
                            getIncrementProps,
                            getDecrementProps
                          }) =>
                            <form {...getFormProps()}>
                                <IconButton size="small" className='my-button'  {...getDecrementProps()} color="success" aria-label="add cart" component="span">
                                    <RemoveIcon  />
                                  </IconButton>
                                <input type="number" readonly='true' id={'qty'+key} idMenu={item._id} priceMenu={item.price} style={{
                                  width: "40px",
                                  textAlign: "center"
                                }} className='my-step-input' {...getInputProps()} />
                                 <IconButton size="small"  className='my-button'  {...getIncrementProps()} color="success" aria-label="add cart" component="span">
                                    <AddIcon   />
                                  </IconButton>
                            </form>}
                        />

                    </div>
                  </Col>
                </Col>
          </Row>
          )}
          <Row>
            <Snackbar
                anchorOrigin={{ vertical, horizontal }}
                key={'${vertical},${horizontal}'}
                open={openCart}>
                  <Alert severity="success">
                     <NumberFormat value={this.state.priceCart}  displayType={'text'} thousandSeparator={true} renderText={value => <span> Order Now {value}</span>} />
                  </Alert>
                </Snackbar>
          </Row>
          </Col>



          <Modal show={this.state.modalPhone} className={styles.ModalPhone}>
            <Modal.Header>
              <Modal.Title className={styles.TitleModal}>Masukkan Nomor Handphone</Modal.Title>
            </Modal.Header>
            <Modal.Body>
              
              <Form>
                <Form.Group controlId="formBasicName">
                  <Form.Control type="text" placeholder="Nama Anda"/>
                </Form.Group>
                <Form.Group controlId="formBasicPhone">
                  <Form.Control type="number" placeholder="No Handphone"/>
                </Form.Group>
              </Form>

            </Modal.Body>
            <Modal.Footer>
              <Button variant="outlined" size="small" color="danger" onClick={this.modalPhone}>
                Cancle
              </Button>
              <Button disabled={this.state.disabled} variant="outlined" size="small" color="primary" onClick={this.clickOTP}>
                Kirim OTP
              </Button>
            </Modal.Footer>
          </Modal>

          <Snackbar
            anchorOrigin={{ vertical, horizontal }}
            key={'${vertical},${horizontal}'}
            open={open}
            onClose={this.snackBarClose}
            message="OTP Terkirim"
          />
          
        </Container>
        );
        
    }
  }
}

export default App;
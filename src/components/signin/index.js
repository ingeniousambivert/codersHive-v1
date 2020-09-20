import React from 'react';
import {
  Row, Col, Form, Input, Button, Typography, message,
} from 'antd';
import { MailOutlined, LockOutlined } from '@ant-design/icons';
import { Link } from 'react-router-dom';

import Background from '@images/illustrations/signup_banner.svg';

const { Text } = Typography;

const imageStyle = {
  backgroundImage: `url(${Background})`,
  backgroundRepeat: 'no-repeat',
  height: '70vh',
  backgroundSize: 'cover',
  backgroundPosition: 'center',
};

function SignInComponent() {
  const onFinish = (credentials) => {
    // (async (credentials, error) => {
    //   await dispatch(signInUserThunk(credentials)).then(() => {
    //     if (error) {
    //       if (error.indexOf("NotAuthenticated") > -1) {
    //         message.error("Failed to sign in. Invalid credentials", 10);
    //       } else {
    //         console.error(error);
    //         message.error(`${error}. Please try again later.`, 10);
    //       }
    //     }
    //   });
    // })(credentials, error);
  };

  const onFinishFailed = (error) => {
    console.error('Failed : ', error);
  };

  return (
    <>
      <div>
        <Row gutter={[16, 24]} justify="space-around" align="middle">
          <Col style={imageStyle} xs={0} sm={0} md={0} lg={10} xl={10} />
          <Col xs={20} sm={20} md={18} lg={8} xl={8}>
            <Row gutter={[16, 24]} justify="center" align="middle">
              <Col xs={24} sm={24} md={24} lg={24} xl={24}>
                <h1 style={{ textAlign: 'center' }}>
                  <b>Welcome Back</b>
                </h1>
              </Col>
            </Row>
            <Form
              hideRequiredMark
              name="signin_form"
              initialValues={{
							  remember: true,
              }}
              size="large"
              onFinish={onFinish}
              onFinishFailed={onFinishFailed}
            >
              <Form.Item
                name="email"
                rules={[
								  {
								    required: true,
								    message: 'Please input your E-mail',
								  },
								  {
								    type: 'email',
								    message: 'Please input a valid E-mail',
								  },
                ]}
              >
                <Input
                  prefix={<MailOutlined />}
                  autoFocus
                  placeholder="E-mail"
                />
              </Form.Item>

              <Form.Item
                name="password"
                rules={[
								  {
								    required: true,
								    message: 'Please input your Password',
								  },
                ]}
              >
                <Input.Password
                  prefix={<LockOutlined />}
                  placeholder="Password"
                />
              </Form.Item>

              <Form.Item>
                <Row gutter={[16, 24]} justify="space-around" align="middle">
                  <Col
                    style={{ textAlign: 'center' }}
                    xs={24}
                    sm={24}
                    md={8}
                    lg={8}
                    xl={8}
                  >
                    <Button type="primary" block htmlType="submit">
                      <Text style={{ color: '#fff' }} strong>
                        Sign In
                      </Text>
                    </Button>
                  </Col>
                  <Col
                    style={{ textAlign: 'center' }}
                    xs={24}
                    sm={24}
                    md={16}
                    lg={16}
                    xl={16}
                  >
                    <Text strong> Don't have an account? </Text>
                    <Link
                      style={{
											  color: '#6E70E5',
                      }}
                      to="/signup"
                      variant="body2"
                    >
                      <b> Sign Up</b>
                    </Link>
                  </Col>
                </Row>
              </Form.Item>
            </Form>
          </Col>
        </Row>
      </div>
    </>
  );
}

export default SignInComponent;
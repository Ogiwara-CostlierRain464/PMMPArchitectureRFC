<?php
namespace ogiwara\oauth\interfaces;

interface State{}

interface BeforeAuth extends State{}
interface AfterAuth extends State{}

class NonRegister implements BeforeAuth{}
class NonLogin implements BeforeAuth{}
class Logined implements AfterAuth{}
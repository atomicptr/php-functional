# Atomicptr\Functional\Result  

Represents a result of an operation that can either succeed with a value or fail with an error.

## Implements:
Atomicptr\Functional\Monad



## Methods

| Name | Description |
|------|-------------|
|[bind](#resultbind)||
|[capture](#resultcapture)|Executes a function and captures its result or any thrown exception into a Result.|
|[error](#resulterror)|Creates a failed Result containing the given error.|
|[flatMap](#resultflatmap)|Returns None if the option is None, otherwise calls fn with the wrapped value and returns the result.|
|[get](#resultget)||
|[hasError](#resulthaserror)|Checks if this Result represents an error.|
|[isOk](#resultisok)|Checks if the Result is OK|
|[ok](#resultok)|Creates a successful Result containing the given value.|
|[orElse](#resultorelse)|Returns value of object if present, otherwise returns $value (executes it if its callable)|
|[panic](#resultpanic)|Creates an exception out of the error, for re-integration with a "normal" PHP environment that expects exceptions|
|[toOption](#resulttooption)|Result as an Option, mapping Result::ok(...) to Option::some(...) and Result::error(...) to Option::none()|
|[value](#resultvalue)|Returns the success value if this Result represents success.|




### Result::bind  

**Description**

```php
 bind (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Result::capture  

**Description**

```php
public static capture (callable $fn)
```

Executes a function and captures its result or any thrown exception into a Result. 

 

**Parameters**

* `(callable) $fn`
: The function to execute  

**Return Values**

`\Result<\T,\Err>`

> A Result containing either the function's return value or the caught exception


<hr />


### Result::error  

**Description**

```php
public static error (\Err $error)
```

Creates a failed Result containing the given error. 

 

**Parameters**

* `(\Err) $error`
: The error value  

**Return Values**

`\Error<\Err>`

> A Result representing failure


<hr />


### Result::flatMap  

**Description**

```php
public flatMap (\T $)
```

Returns None if the option is None, otherwise calls fn with the wrapped value and returns the result. 

 

**Parameters**

* `(\T) $`
: U|Error<U, UErr>  

**Return Values**

`\Result<\U,\UErr>`




<hr />


### Result::get  

**Description**

```php
 get (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Result::hasError  

**Description**

```php
public hasError (void)
```

Checks if this Result represents an error. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`bool`

> True if this Result contains an error, false otherwise


<hr />


### Result::isOk  

**Description**

```php
public isOk (void)
```

Checks if the Result is OK 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`bool`




<hr />


### Result::ok  

**Description**

```php
public static ok (\T $value)
```

Creates a successful Result containing the given value. 

 

**Parameters**

* `(\T) $value`
: The success value  

**Return Values**

`\Ok<\T>`

> A Result representing success


<hr />


### Result::orElse  

**Description**

```php
public orElse (void)
```

Returns value of object if present, otherwise returns $value (executes it if its callable) 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T|\U`




<hr />


### Result::panic  

**Description**

```php
public panic (void)
```

Creates an exception out of the error, for re-integration with a "normal" PHP environment that expects exceptions 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


**Throws Exceptions**


`\ResultError`


<hr />


### Result::toOption  

**Description**

```php
public toOption (void)
```

Result as an Option, mapping Result::ok(...) to Option::some(...) and Result::error(...) to Option::none() 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Option<\T>`




<hr />


### Result::value  

**Description**

```php
public value (void)
```

Returns the success value if this Result represents success. 

Throws an assertion error if this Result represents an error. 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T`

> The success value


**Throws Exceptions**


`\AssertionError`
> If this Result represents an error

<hr />


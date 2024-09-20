# Atomicptr\Functional\Result  

Represents a result of an operation that can either succeed with a value or fail with an error.





## Methods

| Name | Description |
|------|-------------|
|[bind](#resultbind)|Applies a function to the success value (if any) and returns the result.|
|[capture](#resultcapture)|Executes a function and captures its result or any thrown exception into a Result.|
|[collection](#resultcollection)|Returns a collection of T when it has a value, otherwise returns an empty collection.|
|[error](#resulterror)|Creates a failed Result containing the given error.|
|[errorValue](#resulterrorvalue)|Returns the error value if this Result represents an error.|
|[hasError](#resulthaserror)|Checks if this Result represents an error.|
|[ok](#resultok)|Creates a successful Result containing the given value.|
|[panic](#resultpanic)|Creates an exception out of the error, for re-integration with a "normal" PHP environment that expects exceptions|
|[toOption](#resulttooption)|Result as an Option, mapping Result::ok(...) to Option::some(...) and Result::error(...) to Option::none()|
|[value](#resultvalue)|Returns the success value if this Result represents success.|




### Result::bind  

**Description**

```php
public bind (callable $fn)
```

Applies a function to the success value (if any) and returns the result. 

If this Result represents an error, returns the original error Result without calling the function. 

**Parameters**

* `(callable) $fn`
: The function to apply to the success value  

**Return Values**

`\Result<\U,\E>`

> The result of applying the function, or the original error Result


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


### Result::collection  

**Description**

```php
public collection (void)
```

Returns a collection of T when it has a value, otherwise returns an empty collection. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Collection<\T>`




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

`\Result<\T,\Err>`

> A Result representing failure


<hr />


### Result::errorValue  

**Description**

```php
public errorValue (void)
```

Returns the error value if this Result represents an error. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Err|null`

> The error value, or null if this Result represents success


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

`\Result<\T,\Err>`

> A Result representing success


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


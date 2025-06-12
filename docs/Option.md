# Atomicptr\Functional\Option  

Represents an optional value: every Option is either Some and contains a value, or None, and does not.

This type is used in cases where a value may or may not be present.  

## Implements:
Atomicptr\Functional\Monad



## Methods

| Name | Description |
|------|-------------|
|[bind](#optionbind)||
|[flatMap](#optionflatmap)|Returns None if the option is None, otherwise calls fn with the wrapped value and returns the result.|
|[get](#optionget)||
|[isNone](#optionisnone)|Checks if this Option is a None variant.|
|[isSome](#optionissome)|Checks if this Option is a Some variant.|
|[none](#optionnone)|Creates a None variant of Option, representing the absence of a value.|
|[orElse](#optionorelse)|Returns value of object if present, otherwise returns $value (executes it if its callable)|
|[some](#optionsome)|Creates a Some variant of Option containing the given value.|
|[value](#optionvalue)|Returns the contained value if this Option is Some.|




### Option::bind  

**Description**

```php
 bind (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Option::flatMap  

**Description**

```php
public flatMap (\T $)
```

Returns None if the option is None, otherwise calls fn with the wrapped value and returns the result. 

 

**Parameters**

* `(\T) $`
: U|Option<U>  

**Return Values**

`\Option<\U>`




<hr />


### Option::get  

**Description**

```php
 get (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Option::isNone  

**Description**

```php
public isNone (void)
```

Checks if this Option is a None variant. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`bool`

> True if this Option is None, false otherwise.


<hr />


### Option::isSome  

**Description**

```php
public isSome (void)
```

Checks if this Option is a Some variant. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`bool`

> True if this Option is Some, false otherwise.


<hr />


### Option::none  

**Description**

```php
public static none (void)
```

Creates a None variant of Option, representing the absence of a value. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\None`

> An Option representing no value.


<hr />


### Option::orElse  

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


### Option::some  

**Description**

```php
public static some (\T $value)
```

Creates a Some variant of Option containing the given value. 

 

**Parameters**

* `(\T) $value`
: The value to wrap in Some.  

**Return Values**

`\Some<\T>`

> An Option containing the value.


<hr />


### Option::value  

**Description**

```php
public value (void)
```

Returns the contained value if this Option is Some. 

Throws an assertion error if this Option is None. 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T`

> The contained value.


**Throws Exceptions**


`\AssertionError`
> If this Option is None.

<hr />


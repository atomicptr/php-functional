# Atomicptr\Functional\Option  

Represents an optional value: every Option is either Some and contains a value, or None, and does not.

This type is used in cases where a value may or may not be present.  





## Methods

| Name | Description |
|------|-------------|
|[get](#optionget)|Returns the contained value if this Option is Some.|
|[isNone](#optionisnone)|Checks if this Option is a None variant.|
|[isSome](#optionissome)|Checks if this Option is a Some variant.|
|[map](#optionmap)|Returns None if the option is None, otherwise calls fn with the wrapped value and returns the result.|
|[none](#optionnone)|Creates a None variant of Option, representing the absence of a value.|
|[orElse](#optionorelse)|Returns value of object if present, otherwise returns $value (executes it if its callable)|
|[some](#optionsome)|Creates a Some variant of Option containing the given value.|




### Option::get  

**Description**

```php
public get (void)
```

Returns the contained value if this Option is Some. 

Throws an assertion error if this Option is None. 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T`

> The contained value.


**Throws Exceptions**


`\InvariantViolationException`
> If this Option is None.

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


### Option::map  

**Description**

```php
public map (callable $fn)
```

Returns None if the option is None, otherwise calls fn with the wrapped value and returns the result. 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`\Option<\U>`




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
public orElse (\U|callable $value)
```

Returns value of object if present, otherwise returns $value (executes it if its callable) 

 

**Parameters**

* `(\U|callable) $value`

**Return Values**

`\U`




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


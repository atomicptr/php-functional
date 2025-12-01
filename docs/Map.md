# Atomicptr\Functional\Map  

An immutable key-value map implementation with functional programming operations.

The Map class provides a safe, immutable way to store and manipulate key-value pairs
with type-safe operations. All modification operations return a new instance of the map.  

## Implements:
Traversable, IteratorAggregate, ArrayAccess



## Methods

| Name | Description |
|------|-------------|
|[collection](#mapcollection)|Converts the map to a Collection instance.|
|[empty](#mapempty)|Creates a new empty Map instance.|
|[exists](#mapexists)|Checks if a key exists in the map.|
|[filter](#mapfilter)|Filters the map using a predicate function.|
|[find](#mapfind)|Finds the first value that matches the predicate function.|
|[forAll](#mapforall)|Executes a function for each key-value pair in the map.|
|[from](#mapfrom)|Creates a new Map instance from an associative array.|
|[fromCollection](#mapfromcollection)|Creates a new Map instance from a Collection of key-value pairs.|
|[fromList](#mapfromlist)|Creates a new Map instance from a list of key-value pairs.|
|[get](#mapget)|Retrieves a value by key, wrapped in an Option.|
|[getIterator](#mapgetiterator)|Create an iterator to iterate over maps|
|[intersect](#mapintersect)|Creates an intersection of two maps, keeping only keys that exist in both maps.|
|[keys](#mapkeys)|Returns an array of all keys in the map.|
|[length](#maplength)|Returns the number of key-value pairs in the map.|
|[map](#mapmap)|Maps over the values in the map using a function.|
|[offsetExists](#mapoffsetexists)|Check if the Map has an element for the given key|
|[offsetGet](#mapoffsetget)|Get the element for the given key, throws when it doesn't exist|
|[offsetSet](#mapoffsetset)|This does nothing but throwing|
|[offsetUnset](#mapoffsetunset)|This does nothing but throwing|
|[remove](#mapremove)|Removes a key-value pair from the map, returning a new Map instance.|
|[set](#mapset)|Sets a new key-value pair in the map, returning a new Map instance.|
|[toArray](#maptoarray)|Converts the map to a PHP array.|
|[toList](#maptolist)|Converts the map to a list of key-value pairs.|
|[union](#mapunion)|Creates a union of two maps, with values from the other map taking precedence.|
|[update](#mapupdate)|Updates a value in the map using a function.|
|[values](#mapvalues)|Returns an array of all values in the map.|




### Map::collection  

**Description**

```php
public collection (void)
```

Converts the map to a Collection instance. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Collection<array{\TKey, \TValue}>`

> Collection of [key, value] pairs


<hr />


### Map::empty  

**Description**

```php
public static empty (void)
```

Creates a new empty Map instance. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Map<\TKey,\TValue>`

> A new empty Map instance


<hr />


### Map::exists  

**Description**

```php
public exists (\TKey $key)
```

Checks if a key exists in the map. 

 

**Parameters**

* `(\TKey) $key`
: The key to check  

**Return Values**

`bool`

> True if the key exists, false otherwise


<hr />


### Map::filter  

**Description**

```php
public filter (callable $fn)
```

Filters the map using a predicate function. 

 

**Parameters**

* `(callable) $fn`
: The predicate function  

**Return Values**

`static`

> A new Map instance containing only pairs that match the predicate


<hr />


### Map::find  

**Description**

```php
public find (callable $fn)
```

Finds the first value that matches the predicate function. 

 

**Parameters**

* `(callable) $fn`
: The predicate function  

**Return Values**

`\Option<\TValue>`

> Some(value) if found, None otherwise


<hr />


### Map::forAll  

**Description**

```php
public forAll (callable $fn)
```

Executes a function for each key-value pair in the map. 

 

**Parameters**

* `(callable) $fn`
: The function to execute  

**Return Values**

`void`


<hr />


### Map::from  

**Description**

```php
public static from (void)
```

Creates a new Map instance from an associative array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Map<\TKey,\TValue>`

> A new Map instance


<hr />


### Map::fromCollection  

**Description**

```php
public static fromCollection (\Collection<array{\TKey, \TValue}> $collection)
```

Creates a new Map instance from a Collection of key-value pairs. 

 

**Parameters**

* `(\Collection<array{\TKey, \TValue}>) $collection`
: Collection of [key, value] pairs  

**Return Values**

`\Map<\TKey,\TValue>`

> A new Map instance


<hr />


### Map::fromList  

**Description**

```php
public static fromList (array{\TKey, \TValue}[] $pairs)
```

Creates a new Map instance from a list of key-value pairs. 

 

**Parameters**

* `(array{\TKey, \TValue}[]) $pairs`
: List of [key, value] pairs  

**Return Values**

`\Map<\TKey,\TValue>`

> A new Map instance


<hr />


### Map::get  

**Description**

```php
public get (\TKey $key)
```

Retrieves a value by key, wrapped in an Option. 

 

**Parameters**

* `(\TKey) $key`
: The key to look up  

**Return Values**

`\Option<\TValue>`

> Some(value) if the key exists, None otherwise


<hr />


### Map::getIterator  

**Description**

```php
public getIterator (void)
```

Create an iterator to iterate over maps 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Traversable<\TKey,\TValue>`




<hr />


### Map::intersect  

**Description**

```php
public intersect (\Map<\TKey,\TValue> $other)
```

Creates an intersection of two maps, keeping only keys that exist in both maps. 

 

**Parameters**

* `(\Map<\TKey,\TValue>) $other`
: The map to intersect with  

**Return Values**

`static`

> A new Map instance containing only shared key-value pairs


<hr />


### Map::keys  

**Description**

```php
public keys (void)
```

Returns an array of all keys in the map. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\TKey[]`

> Array of keys


<hr />


### Map::length  

**Description**

```php
public length (void)
```

Returns the number of key-value pairs in the map. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`int`

> The number of pairs


<hr />


### Map::map  

**Description**

```php
public map (callable $fn)
```

Maps over the values in the map using a function. 

 

**Parameters**

* `(callable) $fn`
: The function  

**Return Values**

`\Map<\TKey,\TValue>`

> A new Map instance with transformed values


<hr />


### Map::offsetExists  

**Description**

```php
public offsetExists (\TValue $offset)
```

Check if the Map has an element for the given key 

 

**Parameters**

* `(\TValue) $offset`

**Return Values**

`bool`




<hr />


### Map::offsetGet  

**Description**

```php
public offsetGet (\TKey $offset)
```

Get the element for the given key, throws when it doesn't exist 

 

**Parameters**

* `(\TKey) $offset`

**Return Values**

`\TValue`




<hr />


### Map::offsetSet  

**Description**

```php
public offsetSet (void)
```

This does nothing but throwing 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


**Throws Exceptions**


`\ImmutableException`


<hr />


### Map::offsetUnset  

**Description**

```php
public offsetUnset (void)
```

This does nothing but throwing 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


**Throws Exceptions**


`\ImmutableException`


<hr />


### Map::remove  

**Description**

```php
public remove (\TKey $key)
```

Removes a key-value pair from the map, returning a new Map instance. 

 

**Parameters**

* `(\TKey) $key`
: The key to remove  

**Return Values**

`static`

> A new Map instance without the specified key


<hr />


### Map::set  

**Description**

```php
public set (\TKey $key, \TValue $value)
```

Sets a new key-value pair in the map, returning a new Map instance. 

 

**Parameters**

* `(\TKey) $key`
: The key to set  
* `(\TValue) $value`
: The value to associate with the key  

**Return Values**

`\Map<\TKey,\TValue>`

> A new Map instance with the added key-value pair


<hr />


### Map::toArray  

**Description**

```php
public toArray (void)
```

Converts the map to a PHP array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Map::toList  

**Description**

```php
public toList (void)
```

Converts the map to a list of key-value pairs. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`array{\TKey, \TValue}[]`

> List of [key, value] pairs


<hr />


### Map::union  

**Description**

```php
public union (\Map<\TKey,\TValue> $other)
```

Creates a union of two maps, with values from the other map taking precedence. 

 

**Parameters**

* `(\Map<\TKey,\TValue>) $other`
: The map to union with  

**Return Values**

`static`

> A new Map instance containing all key-value pairs from both maps


<hr />


### Map::update  

**Description**

```php
public update (\TKey $key, callable $fn)
```

Updates a value in the map using a function. 

 

**Parameters**

* `(\TKey) $key`
: The key to update  
* `(callable) $fn`
: The function  

**Return Values**

`static`

> A new Map instance with the updated value


<hr />


### Map::values  

**Description**

```php
public values (void)
```

Returns an array of all values in the map. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\TValue[]`

> Array of values


<hr />

